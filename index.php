<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>

        body{
          background:#e7dfdf;
        }
        .fr_div{
            width: 60%;
            margin: 0 auto;
            margin-top: 16px;
        }
        .tab{
            margin-top: 10px;
        }

        .modal{
          width: 400px;
        }

        .tab{
          width: 90%;
        }

        .tp{
          margin-top: 100px;
        }
      
       input{
        padding: 10px;
       }

      input[type=text]{
        width: 100%;
        padding: 8px;
      }

      input[type=submit]{
        margin-top: 5px;
        padding: 5px;
      }

      .main_h{
        text-align: center;
      }


    </style>  
</head>
  <body>
    
    <div class="row tp">
     
      <div class="col-md-6"> 
        
           <div id="success_msg"></div>
           <div id="error_msg"></div>
           <div class="fr_div">
            <h2 class="main_h">JQuery Ajax Crud</h2>
            <div id="modal">
              <div id="modal-form">
                <table border="1"></table>
                <div class="close_btn">x</div>
              </div>
            </div>
            
              <input type="text" id="searchable" placeholder="Search">
           
               <form action="">
                <label for="fr">First Name</label>
                <input type="text" placeholder="First name" id="fr" name="fr">

                <label for="fr">Last Name</label>
                <input type="text" placeholder="First name" id="lr" name="lr">

                <input type="submit" id="save" value="Submit">
               </form>
                
            </div>
      </div>

      <div class="col-md-6">
        <div class="tab">
         <table border="5" width="30.2%" align="center" class="tab">
            <tr>
                <td id="t_data"></td>
            </tr>
          </table>
        </div>
         
      </div>
    </div>
 
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    <!--Jquery cdn-->  
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
         function LoadTable(){
            $.ajax({
              url: "load_table.php",
              type: "POST",
              success: function(data){
                $("#t_data").html(data);
                
              }
            });
         }

         LoadTable();

         $("#save").on("click",function(){
            var fr=$("#fr").val();
            var lr=$("#lr").val();

            if(fr=="" || lr==""){
             $("#error_msg").html("All field are required").slideToggle();
             $("#success_msg").slideUp();
            }else{
            $.ajax({
            url :"data_insert.php",
            type : "POST",
            data : {first_name:fr ,last_name:lr},
            success : function(data){
            
              if(data == 1){
               LoadTable();
               $("#success_msg").html("Data Insert Success").slideToggle();
              }else{
              $("#error_msg").html("Data Insert Fail").slideToggle();
              }
            }
            });
            }
          
         });


        $(document).on("click",".delete_btn",function(){
          var StudentId = $(this).data("id");
          var element = this;

          $.ajax({
            url :"data_delete.php",
            type :"POST",
            data : {sid:StudentId},
            success : function(data){
                console.log(data);
                if(data == 1){
                    $(element).closest("tr").fadeOut();
                }else{
                    $("#error_msg").html("Can't Delete").slideDown();
                    $("success_msg").slideUp();
                }
            }
          });
        });

        $(document).on("click",".edit_btn",function(){
          $("#modal").show();
          $studentId = $(this).data("eid");

          $.ajax({
            url : "modal_update.php",
            type : "POST",
            data : {id:$studentId},
            success : function(data){
             $("#modal-form table").html(data);
            }
          });
        });

        $(document).on("click",".close_btn",function(){
          $("#modal").hide();
        });

        $(document).on("click",".edit_form",function(){
         $ids = $("#edit_id").val();
         $fn = $("#edit_fname").val();
         $ln = $("#edit_lname").val();

         $.ajax({
          url : "data_updated.php",
          type : "POST",
          data : {id:$ids,fname:$fn,lname:$ln},
          success : function(data){
           if(data == 1){
            $("#modal").hide();
            LoadTable();
           }

          }
         });
        });

        $("#searchable").on("keyup",function(){
        var search = $(this).val();

        $.ajax({
          url : "search.php",
          type : "POST",
          data : {searchable:search},
          success : function(data){
            console.log(data);
           $("#t_data").html(data);
          }
        });
        });

        });
    </script>

     
</body>
</html>