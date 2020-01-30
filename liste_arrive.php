<?php


$url = 'http://api.aviationstack.com/v1/flights?dep_iata=COO&access_key=4140d310cfe38e527f602320ef59b57f';

$json = file_get_contents($url);
$obj = json_decode($json);


$table_leght = count($obj->data);

// $return_array = array(); // Initializing the array that will be used for the table

// for($i = 0; $i <= $table_leght; $i++ ) {
//     // echo $obj->data[$i]->arrival->airport. '<br />';
// }



// while( $the_query->have_posts() ){

// // Fetch the post
// $the_query->the_post();

// // Filling in the new array entry
// $return_array[] = array(
// 'Id' => get_the_id(), // Set the ID
// 'Title' => get_the_title(), // Set the title
// 'Content preview with link' => get_permalink().'||'.strip_tags( strip_shortcodes( substr( get_the_content(), 0, 200 ) ) ).'...'
// // Get first 200 chars of the content and replace the shortcodes and tags
// );

// }

// // Now the array is prepared, we just need to serialize and output it
// echo serialize( $return_array );

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	
</head>
<style>
    .pagination .page-item.active .page-link {
        background-color: #03a9f4;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link: focus {
        couleur de fond: #03a9f4;
    }

    .pagination .page-item.active .page-link: survol {
        couleur de fond: #03a9f4;
    }

    .new:after {
    content: ''!important;
    display: none !important;
}
</style>
<body>
<h5 class="light-blue-text">Arrivée du Jour</h5>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead  class="light-blue white-text">
            <th>DATE</th>
            <th>HEURE</th>
            <th>COMPAGNIE</th>
            <th>N° VOL</th>
            <th>PROVENANCE</th>
            <th>STATUT</th>
        </thead>

        <tbody>
            <?php 
                
            for($i = 0; $i <= $table_leght; $i++ ) { ?>
            <tr>

                    <td><?php 
 
$newDate = date("d/m/Y", strtotime($obj->data[$i]->arrival->scheduled));
echo $newDate; ?></td>

                    <td><?php 
 
$newDate = date("h:m", strtotime($obj->data[$i]->arrival->scheduled));
echo $newDate; ?></td>

                    <td><?php echo $obj->data[$i]->airline->name; ?></td>
                    <td><?php echo $obj->data[$i]->flight->number; ?></td>
                    <td><?php echo $obj->data[$i]->arrival->airport; ?></td>
                    <td><?php echo $obj->data[$i]->flight_status == 'landed' ? "<span class='new badge green'>Atterie </span> ": '' ,$obj->data[$i]->flight_status == 'active' ? "<span class='new badge red'>Decollé</span> " : '' , $obj->data[$i]->flight_status == 'scheduled' ? "<span class='new badge  orange'>Prévu</span>" : ''; ?></td>

            </tr>
            <?php    
                    }
                ?>
        </tbody>
    </table>

	<script>
            $(document).ready(function() {
                $('#example').DataTable({
                    dom: "<'row'<'col-sm-4'f><'col-sm-offset-2 col-sm-6'B>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-xs-12 col-sm-7 col-sm-offset-5 text-right'p>>",
                    "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [-1]
                    }],
                    "oLanguage": {
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sLast": "Dérnier",
                            "sNext": "Suivant",
                            "sPrevious": "Précedent",
                        },
                        "sSearch": "Recherche:",
                        "sEmptyTable": "Aucune donnée disponible",
                        "sInfo": "affichage de _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty": "Aucune donnée disponible",
                        "sInfoFiltered": "(Recherché sur _MAX_ éléments au total)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "sLengthMenu": "Afficher par _MENU_ éléments",
                        "loadingRecords": "Chargement...",
                        "processing": "procéssus...",
                        "sZeroRecords": "Aucun résultat trouvé",
                    },
                    "iDisplayLength": 10,
                    "lengthChange": false,
                    "info": false,
                    buttons: [{
                        extend: "copyHtml5",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        className: "btn-sm",
                        text: "Copier"
                    }, {
                        extend: "csvHtml5",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        className: "btn-sm"
                    }, {
                        extend: "excelHtml5",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        className: "btn-sm"
                    }, {
                        extend: "pdfHtml5",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        className: "btn-sm"
                    }, {
                        extend: "print",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        className: "btn-sm",
                        text: "Imprimer"
                    }],
                    responsive: false
                });

            });
        </script>

</body>
</html>




