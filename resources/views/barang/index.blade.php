<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title><?= $title ?></title>
</head>
<body>
    
    <div class="container mt-3">
    <a href="javascript:void()" class="btn btn-success btn-sm mr-5 my-2" style="float: right;" onclick="create()">Create</a>
    <table id="table" class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.1/bootbox.min.js"></script>

    <script>

        $(function(){
            get();
        });

        function get(){
            $.ajax({
                url: '<?= route('barang.get') ?>',
                success: function(response){
                    $('#table tbody').html(response);
                }
            });
        }

        function view(id){
            $.ajax({
                url: '<?= route('barang.view') ?>/'+id,
                success: function(response){
                    bootbox.dialog({
                    title: 'View Barang',
                    message: response
                    });
                } 
            });
        }

        function create(){
            $.ajax({
                url: '<?= route('barang.create') ?>',
                success: function(response){
                    bootbox.dialog({
                        title: 'create barang',
                        message: response
                    });
                }
            });
        }

        function edit(id){
            $.ajax({
                url: '<?= route('barang.edit') ?>/'+id,
                success: function(response){
                    bootbox.dialog({
                        title: 'edit barang',
                        message: response
                    });
                }
            });
        }

        function update(id){
            $('#form_barang .alert').remove();
            $.ajax({
                url: '<?= route('barang.update') ?>/'+id,
                dataType: 'json',
                type: 'post',
                data: $('#form_barang').serialize(),
                success: function(response){
                    if(response.success){
                        bootbox.hideAll();
                        alert(response.message);
                        get();
                    }else{
                        alert(response.message);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    var response = JSON.parse(xhr.responseText);
                    $('#form_barang').prepend(validateErrormessage(response));
                }
            });
        }

        function store(){
            $('#form_barang .alert').remove();
            $.ajax({
                url: '<?= route('barang.store') ?>',
                dataType: 'json',
                type: 'post',
                data: $('#form_barang').serialize(),
                success: function(response){
                    if(response.success){
                        bootbox.hideAll();
                        alert(response.message);
                        get();
                    }else{
                        alert(response.message);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    var response = JSON.parse(xhr.responseText);
                    $('#form_barang').prepend(validateErrormessage(response));
                }
            });
        }

        function destroy(id){
            $.ajax({
                url: '<?= route('barang.delete') ?>/'+id,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        alert(response.message);
                    }else{
                        alert(response.message);
                    }
                    get();
                }
            });
        }

        function validateErrormessage(errors){
            var validation = '<div class="alert alert-danger">';
                validation += '<p><b>'+errors.message+'</b></p>';
                $.each(errors.errors, function(i, error){
                    validation += error[0]+'<br>'
                })
                validation += '</div>';
                return validation;
        }
    </script>
</body>
</html>