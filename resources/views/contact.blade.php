@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="" id="contact_form">
            <h1>Contact us</h1>

            <div class="form-group">
                <label for="email">Your email</label>
                <input type="email" class="form-control" 
                name="email" placeholder="Enter your email">
            </div>

            <div class="form-group">
                    <label for="name">Your name</label>
                    <input type="text" class="form-control" 
                    name="name" placeholder="Enter your name">
            </div>

            <div class="form-group">
                    <label for="body">Your message</label>
                    <textarea name="body" class="form-control"></textarea>
                </div>

            <button type="submit" class="btn btn-primary btn-submit">Send message</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $(".btn-submit").click(function(e){
                e.preventDefault();
                var email = $('input[name=email]').val();
                var name = $('input[name=name]').val();
                var body = $('textarea[name=body]').val();

            $.ajax({
                type:'POST',
                contentType: 'application/json',
                url:'/api/contact',
                data:JSON.stringify({
                    email:email,
                    name:name,
                    body:body
                }),
                success:function(res){
                    console.log(res)
                }
            })
            })
        });
    </script>

@endsection