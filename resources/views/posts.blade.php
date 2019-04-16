@extends('layouts.app')

@section('content')

<div class="container">
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

                // console.log(id)

                $.ajax({
                    url: '/api/posts/' + id,
                    type: 'GET',
                    success: function(res){
                        console.log(res)
                    }
                })
            })
        };
    })
</script>
    
@endsection