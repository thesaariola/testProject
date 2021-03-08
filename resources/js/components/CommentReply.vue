<template>
    <li class="mt-2 mb-2" :depth="depth + 1">
        <div class="card card-body mb-2">
            <div>

                <h6>{{comment.username}}</h6>
                <p class="text-sm-right text-secondary" style="font-size:.7rem;">{{comment.created_at}}</p>
                <p class="text-sm">{{comment.comment}}</p>
              
                <!-- Hide Reply Button Depth >= 3 -->

                <ul class="list-inline" >
                    <li class="list-inline-item">
                        <a href="#" @click="isHidden = !isHidden" v-show="depth < 3">Reply</a>
                    </li>
                </ul>

                <!-- Reply Form -->

                <div class="row justify-content-center" v-show="!isHidden">
                    <div class="col-md-8">
                        <div class="card-header mb-2">Reply to a comment:</div>
                        <form @submit.prevent="postReply(comment.id)" class="mb-5">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" placeholder="Your Name" v-model="comment.user">
                                <textarea class="form-control" v-model="comment.reply"
                                ></textarea>
                            </div>

                            <p v-if="errorReplies.length">
                                <ul class="list-unstyled">
                                  <li v-for="error in errorReplies" class="text-warning">{{ error }}</li>
                                </ul>
                            </p>

                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary">Reply</button>
                                <a href="#" @click.prevent="cancel" class="btn btn-link">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

            <template v-if="comment.children">
                <ul class="list-unstyled">
                    <comment v-for="child in comment.children" :key="child.id" :comment="child" :depth="depth + 1"  />        
                </ul>
            </template>
        </div>
    </li>
</template>

<script>
    import Comment from './CommentReply'
    import bus from '../bus'
    export default {
        name: 'comment',
        data (){
            return {
                errorReplies:[],
                isHidden: true,
            }
        },
        props: {
            comment: {
                required: true,
                type: Object
            },
            depth: {
                type: Number,
                default: 0
            },
        },
        components: {
            Comment,
        },
        methods: {
            
            postReply(parentID){


                //Form Validations - Front End
                this.errorReplies = [];

                if (!this.comment.reply) {
                    this.errorReplies.push('Input characters in the reply box.');
                }
                else{

                    //Posting of replies

                    this.comment.parent_id = parentID;

                    fetch('reply/post',{
                        method: 'POST',
                        body: JSON.stringify(this.comment),
                        headers:{
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                       location.reload();
                    })
                }
            },

            cancel () {
                this.isHidden = true;
            }
            
        },
        mounted () {
            
        }
    }
</script>

<style>

.text-sm{
    font-size:.9rem;
    text-align:left;
}
    
</style>