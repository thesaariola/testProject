<template>
    <div class="container">

        <!-- Comment Box -->

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="mx-auto" >
                    <form @submit.prevent="postComment">
                        <div class="card-header mb-2">Leave a comment:</div>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" placeholder="Name" v-model="comment.username">
                        </div>
                        <div class="form-group mb-2">
                            <textarea class="form-control" placeholder="Comment" v-model="comment.comment"></textarea>
                        </div>
                        <p v-if="errors.length">
                            <b>Check the following error(s):</b>
                            <ul>
                              <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <template v-if="comments.length">
            <div class="card-header">View comments:</div>
            <ul class="list-unstyled">
                <comment v-for="comment in comments" :key="comment.id" :comment="comment" />
            </ul>
        </template>

        <p v-else class="mt-5"> No Comments to Display! </p>

    </div>
</template>
  

<script>

    import Comment from './CommentReply'
    import axios from 'axios'

    export default{
       
        data(){
            return {
                errors:[],
                comments:[],
                comment:{
                    id: '',
                    username: '',
                    comment: '',
                },
                isHidden: true,
                depth:0
            }

        },

        components: {
            Comment
        },    

        methods: {
            fetchComments() {
               fetch('api/comments')
                .then(res => res.json())
                .then(res => {
					this.comments  = res.data;
                
				})
            },
            
            postComment(){

                //Form Validations - Front End
                this.errors = [];

                if (!this.comment.comment) {
                    this.errors.push('Input characters in the comment box.');
                }

                if (!this.comment.username) {
                    this.errors.push('Name is required.');
                }


                //Posting of comments    
                fetch('comment/post',{
                    method: 'POST',
                    body: JSON.stringify(this.comment),
                    headers:{
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.comment.username  = '';
                    this.comment.comment  = '';
                    this.fetchComments();
                })
            },
           
            
        },

        mounted(){
            this.fetchComments();
           
        },


    }

</script>

