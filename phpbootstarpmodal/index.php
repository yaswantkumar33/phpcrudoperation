<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Bootstarp models</title>
    <!-- Bootstrap css   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

</head>

<body>
    <!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="completename">Name</label>
                        <input type="text" class="form-control" id="completename" placeholder="Enter Name">

                    </div>
                    <div class="form-group">
                        <label for="completeemail">Email</label>
                        <input type="email" class="form-control" id="completeemail" placeholder="Enter Emial">

                    </div>
                    <div class="form-group">
                        <label for="completemobile">Mobilenumber</label>
                        <input type="number" class="form-control" id="completemobile" placeholder="Enter Mobilenumber">

                    </div>
                    <div class="form-group">
                        <label for="completeplace">Place</label>
                        <input type="text" class="form-control" id="completeplace" placeholder="Enter Place">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- update modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="updatename">Name</label>
                        <input type="text" class="form-control" id="updatename" placeholder="Enter Name">

                    </div>
                    <div class="form-group">
                        <label for="updateemail">Email</label>
                        <input type="email" class="form-control" id="updateemail" placeholder="Enter Emial">

                    </div>
                    <div class="form-group">
                        <label for="updatemobile">Mobilenumber</label>
                        <input type="number" class="form-control" id="updatemobile" placeholder="Enter Mobilenumber">

                    </div>
                    <div class="form-group">
                        <label for="updateplace">Place</label>
                        <input type="text" class="form-control" id="updateplace" placeholder="Enter Place">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">

                </div>
            </div>
        </div>
    </div>






    <div class="container my-3">
        <h1 class="text-center">
            PHP CRUD operation using Bootstrap Modal
        </h1>

        <button type="button" class="btn btn-dark my-4" data-toggle="modal" data-target="#completeModal">
            Add New Users
        </button>
        <!-- <button class="btn btn-dark my-4">Add New user</button> -->
        <div id="displayDataTable"></div>
    </div>












    <!-- bootstrap javascript -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            displayData();
        });

        //display data
        function displayData() {
            var displaydata = "true";
            $.ajax({
                url: "display.php",
                type: "POST",
                data: {
                    displaySend: displaydata
                },
                success: function(data, status) {
                    $('#displayDataTable').html(data);

                }
            })
        }



        function adduser() {
            var nameAdd = $('#completename').val();
            var emailAdd = $('#completeemail').val();
            var mobileAdd = $('#completemobile').val();
            var placeAdd = $('#completeplace').val();


            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    nameSend: nameAdd,
                    emailSend: emailAdd,
                    mobileSend: mobileAdd,
                    placeSend: placeAdd
                },
                success: function(data) {
                    //function to display data
                    $('#completeModal').modal('hide');

                    displayData();


                    //if(data == 'yaswanth'){
                    // reload();
                    // }else{
                    //       alert('no reoload');
                    // }
                }
            });
        }

        function DeleteUser(deleteid) {
            $.ajax({
                url: 'delete.php',
                type: "POST",
                data: {
                    deletesend: deleteid
                },
                success: function(data, status) {
                    displayData();
                }
            })
        }
        //Delete record

        //update function\


        function GetDetails(updateid) {
            $('hiddendata').val(updateid);

            $.post("update.php", {
                updateid: updateid
            }, function(data) {
                var userid = JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updateemail').val(userid.email);
                $('#updatemobile').val(userid.mobile);
                $('#updateplace').val(userid.place);

            });


            $('#updateModal').modal('show');

        }

        //ONCLICK UPDATE EVENT FUNCTION
        function updateDetails() {
            var updatename = $('#updatename').val();
            var updateemail = $('#updateemail').val();
            var updatemobile = $('#updatemobile').val();
            var updateplace = $('#updateplace').val();
            var hiddendata = $('#hiddendata').val();

            $.post("update.php", {
                updatename: updatename,
                updateemail: updateemail,
                updatemobile: updatemobile,
                updateplace: updateplace,
                hiddendata: hiddendata
            }, function(data, status) {
                $('#updateModal').modal('hide');
                displayData();
            });
        }
    </script>




</body>

</html>