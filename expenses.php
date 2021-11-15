<?php
session_start();
$User_ID = $_SESSION["User_ID"];
//echo($User_ID);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expenses</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/efcbdd27a6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
  

</head>

<body>
    <p id="userID" hidden><?php echo $User_ID; ?></p>
    <div id="AddForm" class="modal" > 

  <!-- Modal content -->
    <div class="modal-content" style="width:80%;" >
        <div>
        <h2 style="color:#0275d8;">Add Expense</h2>
        <button type="button" id="AddCategoryBtn" class="btn btn-primary" style="width=10%; float:right;margin-bottom:2px">Add Category</button>
</div>
<br />
        <form id="AddExpenseForm" action="insert_expense.php" method="post" name="AddExpenseForm"  >
            

        <div class="form-group">
            
            <select class="form-control" id="CategoriesSelect" name="CategoriesSelect" required>
            <option value="">Category</option>

            </select>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" id="expenseAmount" name="expenseAmount"  placeholder="Amount">
         </div>
         <div class="form-group">
             <input type="date" class="form-control" id="expensedate" name="expensedate" placeholder="Date">
            </div>
            <input type="submit" class="btn btn-primary" id="SubmitAddExpensebtn" name="SubmitAddExpensebtn" value="Submit">
        </form>
     </div>
     </div>

     <div id="AddCatForm" class="modal" > 

<!-- Modal content -->
  <div class="modal-content" style="width:60%;" >
      
      <form id="AddCategoryForm" action="insert_Category.php" method="post" name="AddCategoryForm"  >
        
      <div class="form-group">
          <input type="text" class="form-control" id="CategoryName" name="CategoryName"  placeholder="Category" Required>
       </div>

          <input type="submit" class="btn btn-primary" id="SubmitAddCategory" name="SubmitAddCategory" value="Submit">
      </form>
   </div>
   </div>


    <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2 style="color:#0275d8;">Expenses</h2>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary" id="AddExpensebtn"><i class="fa fa-plus"></i> Add New</button>
            </div>           
        </div>
        <br />
        <div class="row">
            <div class="col-md-8">
            <div id="EmptyData"></div>
            <div id="table" >

            </div>
            </div>
            <div class="col-md-4">
            <div>
                <canvas id="myChart" width="100%"></canvas>
            </div>
               
            </div>
        </div>
</div>
    </div>
 
        
            
 
       
   
       

    <!-- JS -->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
    <script>
        let User_ID= document.getElementById("userID").innerHTML;
        async function fetchExpenses(){
				const response = await fetch('http://localhost/ExpensesProject_RewaShoujaa/get_expenses.php?id='+User_ID);
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
                console.log("this is the result"+JSON.stringify(results));
				return results; 
			}

		
		function getData(){
			fetchExpenses().then(results => {
				console.log(results);
                if (results.length==0){
                    document.getElementById("EmptyData").innerHTML="No expenses added yet"

                }
                else{
                    document.getElementById("EmptyData").innerHTML=""
                   
                    let table = document.createElement('table');
                    let thead = document.createElement('thead');
                    let tbody = document.createElement('tbody');
                    let row = document.createElement('tr');
                    let header = document.createElement('tr');
                    let column = document.createElement('td');
                    var tableheader='<tr>'+
                    '<th>CATEGORY</th>'+ 
                    '<th>AMOUNT</th>'+ 
                    '<th>DATE</th>'+
                    '<th>ACTIONS</th>'+
                    '</tr>'
                    
                    table.appendChild(thead);
                    table.appendChild(tbody);
                    table.classList.add("table");
                    table.classList.add("table-hover");
                     
                    document.getElementById('table').appendChild(table);
                    $("table thead").append(tableheader);
                    var NewRow="";

                    for(var expense in results) {
                        console.log("expenses"+expense);
                        var indexrow = $("table tbody tr:last-child").index();
                        NewRow= NewRow+'<tr>'
                         for (var details in results[expense]) {
                             if (details=="expense_id"){
                                var rowexpenseID=results[expense][details];
                             }
                             else if (details=="category_id"){
                                var rowCategoryID= rowexpenseID=results[expense][details];
                             }
                             else{
                                 NewRow=NewRow+'<td>'+results[expense][details]+'</td>'
                            }
                            
                        }
                        NewRow=NewRow + 
                        '<td>'+
                        '<a class="add" title="Add" data-toggle="tooltip"><i class="far fa-check-square"></i></a>'+
                        '<a class="edit" title="Edit" data-toggle="tooltip"><i class="far fa-edit"></i></a>'+
                        '<a class="delete" title="Delete" data-toggle="tooltip"><i class="far fa-trash-alt"></i></a>'+
                        '<p class="hide" id="tablecategoryID">'+results[expense]["category_id"]+'</p>'+
                        '<p class="hide" id="tableexpenseID">'+results[expense]["expense_id"]+'</p>'+
                        '</td>'+
                        '</tr>'
                    }
                    $("table tbody").append(NewRow);

                }

			}).catch(error => {
				console.log(error.message);
			})
		}
        getData();
        
        var modal = document.getElementById("AddForm");

        $("#AddExpensebtn").click(function(){
            modal.style.display = "block";
        });

        var modalCat = document.getElementById("AddCatForm");

        $("#AddCategoryBtn").click(function(){
            modalCat.style.display = "block";
        });

    

    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                AddFormReset();
            }
        }

        window.onclick = function(event) {
            if (event.target == modalCat) {
                AddCat_FormReset();
            }
        }

        async function fetchCategories(){
            const response = await fetch('http://localhost/ExpensesProject_RewaShoujaa/get_categories.php?id='+User_ID);
            if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
			}

            $("#AddExpensebtn").click(getCategories);
            function getCategories(){
                fetchCategories().then(results => {
                    
				console.log(results);
                var listitems = "";
                
                for(var Category in results) {
                     listitems += '<option value=' + results[Category]["category_ID"] + '>' + results[Category]["category"] + '</option>';
            
                }
                //console.log("this is the list"+listitems)
                 $("#CategoriesSelect").append(listitems);

			}).catch(error => {
				console.log(error.message);
			})
		}

        function AddFormReset(){
            var Form_add = document.getElementById("AddForm");
            Form_add.style.display = "none";
            $("#expenseAmount").val("");
            $("#CategoriesSelect").val("");
            var expenseDate=$("#expensedate").val("");
        }

        function AddCat_FormReset(){
            var Form_Cat_add = document.getElementById("AddCatForm");
            Form_Cat_add.style.display = "none";
            $("#CategoryName").val("");

        }

        //$("#SubmitAddExpensebtn").click(postExpense);
        $(function() {
            $('#AddExpenseForm').on('submit',  function(e) {
                var expenseAmount=$("#expenseAmount").val();
                var expenseCatID=$("#CategoriesSelect").val();
                var expenseCatName=$("#CategoriesSelect option:selected").text();
                var expenseDate=$("#expensedate").val();
                var expenseID;
                e.preventDefault();
                 $.ajax({
                     type: 'post',
                     url: 'http://localhost/ExpensesProject_RewaShoujaa/insert_expense.php?id='+User_ID,
                     data: {
                         amount: expenseAmount,
                         CategoryID: expenseCatID,
                         Date: expenseDate
                        },
                        success: function(response){
                             //var result= response.json();
                             expenseID=JSON.parse(response).id;
                         },
                        
        });
        //var modal = document.getElementById("AddForm");
        //modal.style.display = "none";
        AddFormReset();
        //modal.reset();
        var newRow='<tr>'+
        '<td class="CategoryNameTbl">'+expenseCatName+'</td>'+
        '<td>'+expenseAmount+'</td>'+
        '<td>'+expenseDate+'</td>'+
        '<td>'+
                        '<a class="add" title="Add" data-toggle="tooltip"><i class="far fa-check-square"></i></a>'+
                        '<a class="edit" title="Edit" data-toggle="tooltip"><i class="far fa-edit"></i></a>'+
                        '<a class="delete" title="Delete" data-toggle="tooltip"><i class="far fa-trash-alt"></i></a>'+
                        '<p class="hide" id="tablecategoryID">'+ expenseCatID+'</p>'+
                        '<p class="hide" id="tableexpenseID">' + expenseID + '</p>'+
                        '</td>'+
                        '</tr>';
        $("table tbody").append(newRow);
        
    });
});

$(function() {
            $('#AddCategoryForm').on('submit',  function(e) {
                
                var CategoryName=$("#CategoryName").val();
                var CategoryID;
                e.preventDefault();
                 $.ajax({
                     type: 'post',
                     url: 'http://localhost/ExpensesProject_RewaShoujaa/insert_Category.php?id='+User_ID,
                     data: {
                        category: CategoryName
                        },
                        success: function(response){
                             //var result= response.json();
                             CategoryID=JSON.parse(response).id;
                         }
                        
        });
        //var modal = document.getElementById("AddForm");
        //modal.style.display = "none";
        AddCat_FormReset();
        //modal.reset();
        var newoption='<option value=' + CategoryID + '>' + CategoryName + '</option>';
        $("#CategoriesSelect").append(newoption);
            
        
        //console.log("this is the list"+listitems)
        
        
    });
});


        async function postExpense(){
                
				result = await $.ajax({
					type: "POST",
					url: 'http://localhost/ExpensesProject_RewaShoujaa/insert_expense.php?id='+User_ID,
                    dataType: "json",
                    data:({"uniId":"test"}),
                })
        }


        async function fetchPIChartData(){
				const response = await fetch('http://localhost/ExpensesProject_RewaShoujaa/get_pieChartData.php?id='+User_ID);
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
			}
            function getRandomColor() {
                var r = () => Math.random() * 256 >> 0;
                var color = `rgb(${r()}, ${r()}, ${r()})`;
                return color;
            }

           
		function getPieChartData(){
			fetchPIChartData().then(results => {
				var ctx = document.getElementById('myChart').getContext('2d');
                var CategoryLabels=[];
                var colors=[];
                var SumData=[];
                for(var sum in results){
                    CategoryLabels.push(results[sum]['category']);
                    SumData.push(results[sum]['Sum']);
                    colors.push(getRandomColor());

                }
                console.log(colors);

                var myChart = new Chart(ctx, {
                    type: 'pie',
        data: {
        labels:CategoryLabels,
        datasets: [{
            label: '# of Votes',
            data: SumData,
            backgroundColor: colors
                   
        }]
    }
});
			}).catch(error => {
				console.log(error.message);
			})
		}
        getPieChartData();


        $(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });

	// Update Row on edit

    async function UpdateAjax(expID,expDate,expAmount){
			try{
				result = await $.ajax({
                     type: 'post',
                     url: 'http://localhost/ExpensesProject_RewaShoujaa/update_expense.php?id='+expID,
                     data: {
                        amount: expAmount,
                        Date:expDate
                        }
                        
        });
			}catch(error) {
				console.log(error);
			}
		}

    $(document).on("click", ".add", function(){
        var expenseID= $(this).parents("tr").find("p").text().charAt(1);
        var expenseAmount=$(this).parents("tr").find("td").text().charAt(1);
        var expenseDate=$(this).parents("tr").find("td").text().charAt(3);
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
    
    
    
    
    
    // Delete row on delete button click

    async function fetchDelete(expID){
				const response = await fetch('http://localhost/ExpensesProject_RewaShoujaa/delete_expense.php?id='+expID);
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				}

	$(document).on("click", ".delete", function(){
        var expenseID= $(this).parents("tr").find("p").text().charAt(1);
        console.log("this is the expense ID"+expenseID);
        $(this).parents("tr").remove();

        fetchDelete(expenseID).catch(error => {
				console.log(error.message);
			})

        
		//$(".add-new").removeAttr("disabled");
    });



        


    </script>
    
    
   
  
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>