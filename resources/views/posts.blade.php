@extends('layouts.app')

@section('content')

<div class="container">

    <div class="edit_post">
        <br>
        <h3>Edit post</h3>
        <hr>
        <form id="edit_one_post">
            <div class="form-group">
                <label for="title">Post title</label>
                <input type="text" class="form-control" name="title" placeholder="Add a title">
            </div>

            <div class="form-group">
                    <label for="body">Post content</label>
                    <input type="text" class="form-control" name="body" placeholder="Add a content">
            </div>

            <input type="hidden" name="post_id">

            <button type="submit" class="btn btn-primary btn-edit">Edit post</button>
            <button type="submit" class="btn btn-danger btn-delete">Delete post</button>
        </form>
    </div>

    <div class="add_post">
        <br>
        <h3>Add post</h3>
        <hr>
        <form id="add_one_post">
            <div class="form-group">
                <label for="title">Post title</label>
                <input type="text" class="form-control" name="title" placeholder="Add a title">
            </div>
    
            <div class="form-group">
                <label for="body">Post content</label>
                <input type="text" class="form-control" name="body" placeholder="Add a content">
            </div>
    
            <button type="submit" class="btn btn-primary btn-submit">Add post</button>
        </form>
    </div>

    <div class="show_all">
        <br>
        <h3>All posts</h3>
        <hr>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        function addOnePost(){
            $('.btn-submit').click(function(e){
                e.preventDefault();
                var title = $('#add_one_post').find('input[name=title]');
                var body = $('#add_one_post').find('input[name=body]');

                $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url:'/api/posts',
                    data:JSON.stringify({
                        title: title.val(),
                        body: body.val()
                    }),
                    success: function(res){
                        console.log(res);
                    }
                })
            })
        }
        addOnePost();

        function editPost(){
            $('.btn-edit').click(function(e){
                e.preventDefault();
                var title = $('#edit_one_post').find('input[name=title]');
                var body = $('#edit_one_post').find('input[name=body]');
                var post_id = $('#edit_one_post').find('input[name=post_id]');

                $.ajax({
                    type:'PUT',
                    contentType: 'application/json',
                    url: '/api/posts/' + post_id.val(),
                    data: JSON.stringify({
                        title: title.val(),
                        body: body.val()
                    }),
                    success: function(res){
                        console.log(res)
                    }
                })
        });

        }

        editPost();

        function deletePost(){
                $('.btn-delete').click(function(e){
                    e.preventDefault();
                    var title = $('#edit_one_post').find('input[name=title]');
                var body = $('#edit_one_post').find('input[name=body]');
                var post_id = $('#edit_one_post').find('input[name=post_id]')

                $.ajax({
                            type: 'DELETE',
                            contentType: 'application/json',
                            url: '/api/posts/' + post_id.val(),
                            success:function(res){
                                console.log(res)
                            }
                        })
                })
        }
        deletePost();

        function getAllPosts(){
            $.ajax({
                url:'/api/posts',
                type:'GET',
                success: function(res){
                    // console.log(res)
                    res.map(function(item){
                        var template = `
                            <div data-id="${item.id}" class="item_db">
                                ${item.id} - ${item.title}
                            </div>
                        `;
                        $('.show_all').append(template);
                    });
                    item_db();
                }
            })
        }
        getAllPosts();

        function item_db(){
            $('.item_db').on('click',function(){
                var id = $(this).data('id')
                var title = $('#edit_one_post').find('input[name=title]');
                var body = $('#edit_one_post').find('input[name=body]');
                var post_id = $('#edit_one_post').find('input[name=post_id]');

                // console.log(id)

                $.ajax({
                    url: '/api/posts/' + id,
                    type: 'GET',
                    success: function(res){
                       // console.log(res)
                       title.val(res.title);
                       body.val(res.body);
                       post_id.val(id);
                    }
                })
            })
        };
    })
</script>
    
@endsection