<!DOCTYPE html>
<html>
 <head>
  <title>Pacijenti</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
 </head>
 <body>
  <br />
  <!-- <div class="container box"> -->
   <h3 align="center">Pacijenti</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Pretraga" />
     </div>
     <div class="table-responsive">
      <h5 align="center">Pronadjeno podataka : <span id="total_records"></span></h5>
      <table class="table table-striped table-sm table-responsive-sm">
       <thead>
       <tr>
        <th>ID</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Datum rodjenja</th><th>Pol</th><th>Adresa</th><th>ID Doktora</th><th>Datum dodele lekara</th><th>LBO</th><th colspan="2"><a href="/tabela/forma/" class="btn btn-success">NOVI PACIJENT</a></th>
       </tr>
       </thead>
       <tbody>
        <?php
      $total_row = $data->count();
      echo 'UKUPNO: '.$total_row;
      if($total_row > 0)
      {
       foreach($data as $row)
       { ?> 
        <tr>
         <td><?=$row->pacijent_id?></td>
         <td><?=$row->ime_pacijenta?></td>
         <td><?=$row->prezime_pacijenta?></td>
         <td><?=$row->email_pacijenta?></td>
         <td><?=$row->datum_rodjenja?></td>
         <td><?=$row->pol?></td>
         <td><?=$row->adresa?></td>
         <td><?=$row->dodeljeni_lekar_id?></td>
         <td><?=$row->datum_dodele_lekara?></td>
         <td><?=$row->lbo?></td>
         <td><a href="/tabela/forma/<?=$row->pacijent_id?>" class="btn btn-info">IZMENI</a></td>
        <td>
            <form method="POST" action="/tabela/<?=$row->pacijent_id?>" />
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE" />
                <input type="submit" value="OBRISI" class="btn btn-danger"/>
            </form>
        </td>
        </tr>
      <?php  
      }
      }
      else
      { ?>
       
       <tr>
        <td align="center" colspan="11">Nema podataka</td>
       </tr>
      <?php
      }
      ?>
       </tbody>
      </table>
     </div>
    </div>    
   </div>
  <!-- </div> -->
 </body>
</html>

<script>
$(document).ready(function(){

 fetch_patients_data();

 function fetch_patients_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'text',
   success:function(data)
   {
    $('tbody').html(data);
    //$('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_patients_data(query);
 });
});
</script>