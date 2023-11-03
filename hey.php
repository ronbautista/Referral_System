<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Left Sidebar (Contacts) -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Contacts
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Contact 1</li>
                            <li class="list-group-item">Contact 2</li>
                            <li class="list-group-item">Contact 3</li>
                            <!-- Add more contacts here -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (Message Box) -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Chat with Contact
                    </div>
                    <div class="card-body">
                        <div id="message-box">
                            <!-- Messages will be displayed here -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type your message...">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
