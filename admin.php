<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat Admin User (Pusher)</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Chat Admin User (Pusher)</h1>
    
        <form id="chat-form" method="post" class="mb-4">
            <div class="form-group">
                <input type="text" id="message" name="message" placeholder="Ketik pesan Anda" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>

        <!-- Area untuk menampilkan pesan -->
        <ul id="messages" class="list-group">
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
    <script>
        $(document).ready(function(){
            var pusher = new Pusher('YOUR_APP_KEY', {
                cluster: 'CLUSTER',
                encrypted: true
            });

            var channel = pusher.subscribe('chat');
            channel.bind('message', function(data) {
                $('#messages').append('<li class="list-group-item"><strong>' + data.role + ':</strong> ' + data.message + '</li>');
            });

            $('#chat-form').submit(function(e){
                e.preventDefault();
                $.post('send.php', {message: $('#message').val()}, function(data){
                    $('#message').val('');
                });
            });
        });
    </script>
</body>
</html>