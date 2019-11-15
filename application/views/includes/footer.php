
    <script src="<?php echo base_url('static/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/adminlte.min.js'); ?>"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo base_url('static/js/app.js'); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

   <?php if( str_replace(' ', '', $_SERVER["REQUEST_URI"]) == "/todo/students/todos"){?>  
    <script >
      
        $(document).ready( function () {
           var datatble = $('#example2').DataTable();
            let b_url = "<?= base_url();?>";
            $(".searchDate").val("<?= date("Y-m-d");?>");
            $(".searchDate").on("change", function(){
                if($(this).val() != ""){
                    axios.get(b_url+'api/todos/' + $(this).val())
                    .then(function(response){
                        var res = response.data;
                        var renderData ="";
                        if(res.data.length > 0){
                            var tdata = res.data.map( dta => {
                            renderData  += `
                            <tr role="row">
                            <td class="sorting_1">${dta.todo_id}</td>
                            <td class="sorting_1">${dta.fullname}</td>
                            <td class="sorting_1">${dta.completed}</td>
                            <td class="sorting_1">${dta.created_date}</td> <td>`;
                            var user_ID = <?= $user["user_id"];?>;
                            var base_url =" <?= base_url();?>";

                            if(dta.user_id != user_ID){
                              
                                renderData  += `<a href="${base_url+"viewtodo/"+dta.todo_id}"><i class="fa fa-eye"></i> View</a>`;
                            }else{
                            
                                renderData  += `<a href="${base_url+"edittodos/"+dta.todo_id}"><i class="fa fa-eye"></i> View</a>`;
                            }
                            renderData  += ` </td></tr>`;
                        })
                        }
                        else{
                            var renderData ="<tr><td colspan='6'>No data found!</td></tr>";
                        }
                        $("#example2 tbody").html(renderData);
                        $('#example2').DataTable();
                        
                    });  
                }    
            })    
        });
    </script>
   <?php }?>

<?php 
    if( $this->uri->segment(2) == "edittodo"){
        ?>
              <script>
        $(document).ready(function(){
            let b_url = "<?= base_url();?>";

            var todo_id = <?= $todos[0]["todo_id"];?>

            let renderInstruction = async () =>{
                let response = await axios.get(b_url+'api/todosinstruction/' + todo_id)
                let res = response.data;
                let render ="";
                if(res.data.length > 0){
                    let r = res.data.map((dta, index) => {
                        render += `
                        <div>
                            <span style="color:#2da0ac">Instruction ${index+1} :</span>
                            <div style="font-size:15px">
                              <span class="instructiondata">${dta.instruction}</span>
                               
                                <a  class="btnDleteAddInsts" id="${dta.id}" style="color:red;" href="javascript:;"><i class="fa fa-trash"></i></a>
                                <a class="btnEditInstruction" ref="${dta.id}" href="javascript:;"><i class="fa fa-edit"></i></a>
                            </div>
                            <hr>
                        </
                        div>`;
                    })
                }else{
                    render = `
                        <div>      
                          No additional Instruction...
                        </div>`;
                }        
                $(".card-cont").html(render);
                
            }
            renderInstruction();
             $(document).on("click", ".btnDleteAddInsts", function(){
                (async () => {
                    let frmdata = new FormData();
                    let todo_id = $(this).attr("id");
                     frmdata.append("id", todo_id);
                    let res = await axios.post(b_url+"api/deletetodo/", frmdata);
                    if(res.data.message =="success"){
                        renderInstruction();
                    }
                })();
            })      
            $(document).on("click", ".btnEditInstruction", function(){
               let node =   $(this).siblings('.instructiondata').html();
               $("#modal-default").modal();
               $id = $(this).attr("ref");
               $(".btnSaveAddInfo").html("Update Changes").removeClass("btnSaveAddInfo").addClass("btnUpdateInfo").attr("ref", $id);
               CKEDITOR.instances['editor'].setData(node)

            })
         
            $(document).on("click" ,".btnUpdateInfo", function (){
                let id = $(this).attr("ref");
              let content =  CKEDITOR.instances['editor'].getData();
                
                if(id && content != ""){
                    (async () => {
                    let frmdata = new FormData();
                     frmdata.append("id", id);
                     frmdata.append("content", content);
                    let res = await axios.post(b_url+"api/updatetodo/", frmdata);
                    if(res.data.message =="success"){
                        renderInstruction();
                        alert("Updated Successfully!")
                        $("#modal-default").modal("hide");
                    }
                    else{
                        alert("Something Wrong!");
                    }
                })();
                }
            })
            
        })
    </script>


    <script >
          CKEDITOR.replace( 'editor' );
          CKEDITOR.instances['editor'].setData("")
          
          let b_url = "<?= base_url();?>";

          $(document).on("click", ".btnSaveAddInfo", function (){
            const editorData = CKEDITOR.instances['editor'].getData()
            if(editorData == "" || editorData == undefined){
                return;
            }
            let todo_id = $(this).attr("id");
             let frmdata = {
                 content : editorData,
                 todo_id : todo_id
             }
             let formdata = new FormData();
             formdata.append("content", editorData)
             formdata.append("todo_id", todo_id)
             axios.post(b_url+"api/addtodoinstruction/", formdata)
             .then((response)=>{
                let res = response.data;
                let render = "";
                if(res.data.length > 0){
                    let r = res.data.map((dta, index) => {
                        render += `
                        <div>
                            <span style="color:#2da0ac">Instruction ${index+1} :</span>
                            <div style="font-size:15px">
                                <span class="instructiondata">${dta.instruction}</span>
                               
                                <a class="btnDleteAddInsts" style="color:red;" href="javascript:;"><i class="fa fa-trash"></i></a>
                                <a class="btnEditInstruction" href="javascript:;"><i class="fa fa-edit"></i></a>
                            </div>
                            <hr>
                        </
                        div>`;
                    })

                    $(".card-cont").html(render);
                    $("#modal-default").modal("hide");
                    CKEDITOR.instances['editor'].setData("")
                }         
             }).catch(()=>{
              
             })
         })

         let getAddInstruction = async () => {
            let res =  await axios.get(b_url+"api/todos/"+date);
         }
    </script>
        <?php
    }
?>

<?php if($this->uri->segment(2) == "dashboard" || ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "")){?> 
    <script>

       $(document).ready(function (){
           
        var tble =  $('#example2').DataTable();
            let b_url = "<?= base_url();?>";
            $("#dateSearchTodoAdmin").val("<?= date("Y-m-d");?>");
             let  getTodos = async (date='') =>{
                let res =  await axios.get(b_url+"api/todos/"+date);
                let todos = res.data.data;
                let render ="";
                tble.destroy();
                if(todos.length > 0){
                   let datas = todos.map((todo, index) => {
                       render +=`
                         <tr role="row">
                            <td class="sorting_1">${todo.todo_id}</td>
                            <td class="sorting_1">${todo.fullname}</td>
                            <td style="width:40%;">${todo.content}</td>
                            <td class="sorting_1">${todo.completed}</td>
                            <td class="sorting_1">${todo.created_date}</td>
                            <td>
                            <a href="${b_url}admin/edittodo/${todo.todo_id}"><i class="fa fa-edit"></i>Edit</a>
                            <a style="color:#a42828;display:inline-block;margin-left:10px;" href="${b_url}admin/deletetodo/${todo.todo_id}"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                       ` 
                    })
                    $("#example2 tbody").html(render);  
                    tble = $('#example2').DataTable();
                }else{
                    $("#example2 tbody").html(render);  
                    tble = $('#example2').DataTable();
                    // render +=`<tr role="row"><td colspan="6">No data found!</td></tr>`;
                }
            }
           $("#dateSearchTodoAdmin").on("change", function(){
                let dateVal  = $(this).val();
                if(dateVal){
                    getTodos(dateVal);
                }
           })
       })
       
    </script>

<?php }?>


<?php if( str_replace(' ', '', $_SERVER["REQUEST_URI"]) == "/todo/admin/createexam"){?>  
    <script>
        $(document).ready(function(){
            let b_url = "<?= base_url();?>";
            var questions = [];

           $('#btnAddQuestion').click(function(){
              $("#question_modal").modal();
           })

           $("#selExamType").change(function(){
               let val  = $(this).val();
               if(val == "Choices"){
                    $(".selChoices").show()
                    $(".selNoChoices").hide()
               }else if(val == "No Choices"){
                    $(".selChoices").hide()
                    $(".selNoChoices").show()
               }
               else{
                  $(".selChoices").hide()
                    $(".selNoChoices").hide()
               }
               
           })
    
        $("#btnSaveExam").click(function(){
            let category = $("#examtype").val()
            if(category == ""){
                viewMsg();
                return false;
            }
            if(questions.length > 0){
                let frmdata = new FormData();
                let questJson = JSON.stringify(questions);
                frmdata.append("category",category );
                frmdata.append("question",  questJson);
                 let saveExam = async () =>{
                    let res =  await axios.post(b_url+"api/saveexam/", frmdata);
                    if(res){
                        if(res.data.code == 200){
                            alert("saved!");
                            window.location = "http://localhost/todo/admin/exams";
                        }
                        else{
                            alert("something wrong");
                        }
                    }
                }
               saveExam();
            }
        })

        function formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
              formData.append(key, obj[key]);
            }
            return formData;
          }
        

        $("#btnASaveQuestion").on("click", function(e){
           let selval = $("#selExamType").val();
           let question = {}
           if(selval){
              if(selval == "Choices"){
        
                 question = {
                    qtype:selval,
                    question : $("#tbxQuestion").val(),
                    choiceA : $("#tbxChoiceA").val(),
                    choiceB : $("#tbxChoiceB").val(),
                    choiceC : $("#tbxChoiceC").val(),
                   Answer : $("#selAnswer").val()
                 }

                 if(!validateQuestion(question)){
                    viewMsg();
                 }
                 else{
                    questions.push(question);
                    generateQuestion()

                 }

               }else if(selval == "No Choices"){
                question = {
                    qtype:selval,
                    question : $("#tbxQuestion2").val(),
                    Answer : $("#tbxAnswer").val()
                 } 
                 if(!validateQuestion(question)){
                    viewMsg();
                 }
                 else{
                    questions.push(question);
                    generateQuestion()
                 }
               }
           }
           else{
              viewMsg();
           }
        })
        
        function generateQuestion(){
            let res = "";

            questions.map((question, index) => {
                let choices ="";
                if(question.qtype == "Choices"){
                    choices += `
                    <div>
                        <ul style="list-style:none;">
                            <li>A: ${question.choiceA}</li>
                            <li>B: ${question.choiceB}</li>
                            <li>C: ${question.choiceC}</li>
                            </ul>
                    </div>
                    `;
                }
                res += `
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a style="display:block;"href="#" data-toggle="collapse" data-target="#collapse${index+1}" aria-expanded="true" aria-controls="collapseOne">Question ${index+1}</a>
                        </h6>
                        </div>

                        <div id="collapse${index+1}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <h6>Question:</h6>
                                <p style="font-style:italic;">${question.question}</p>
                                 ${choices}
                                <h6>Answer: <strong>${question.Answer}</strong></h6>
                            </div>
                        </div>
                    </div>`;
                    
            })
            $("#question_modal").modal("hide");
            $("#accordion").html(res);
            $("#btnSaveExam").attr("disabled",false)
            clearData();
            
        }
        function viewMsg(){
            $(".msgAlert").show();
            setTimeout(() => {
                $(".msgAlert").fadeOut();
            }, 2000);
        }

        function clearData (){
                $("#tbxQuestion").val("")
                $("#tbxChoiceA").val("")
                $("#tbxChoiceB").val("")
                $("#tbxChoiceC").val("")
                $("#selAnswer").val("")
              $("#tbxQuestion2").val("")
                $("#tbxAnswer").val("")
                $("#selExamType").val("");
        }
        function validateQuestion (obj){
           let res = true
            Object.keys(obj).forEach(function(key) {
                if( obj[key] == "" || obj[key] == undefined){
                    res = false;
                }
           });
           return res;
        }
      
    })
        
    </script>
<?php  }?>


<?php 
    if($this->uri->segment(2) == "answerexam"){
        ?>
            <script>
                    let b_url = "<?= base_url();?>";
                    let totalQuestion  = <?php echo count($exams);?>;
                    let answered = 1;
                    let correct = 0;
                $(document).ready(function(){
                    
                    $(document).on("click",".btnCheckAnswer", function(){
                        let questionid = $(this).attr("rel");
                        let exam_id = $(this).attr("ref");
                        let answer = $(this).siblings(".myAnswer").val(); 

                        if(answer == ""){
                           alert("please answer the question first!")
                        }else{
                            (async () => {
                                let formdata = new FormData();
                                formdata.append("questionid", questionid)
                                formdata.append("exam_id", exam_id)
                                let res =  await axios.post(b_url+"api/checkquestion/", formdata);
                                if(res){
                                    if(res.data.code == 200){
                                     
                                        let answer = $(this).siblings(".myAnswer").val(); 
                                       
                                        if(answer == res.data.data[0].answer){
                                            alert("Your Answer is correct");
                                            $(this).siblings(".correcRes").show().html("Correct");
                                            correct++;
                                            let html = `<span ><i class="fa fa-check" style="color:green"></i>  <strong>${res.data.data[0].answer} </strong> is correct. </span>`;
                                            $(this).siblings(".correcRes").show().html(html);
                                        }
                                        else{
                                            alert("Your Answer is Wrong, the correc answer is "+res.data.data[0].answer);
                                            let html = `<span ><i class="fa fa-times" style="color:red"></i> The correct answer is <strong>${res.data.data[0].answer} </strong> </span>`;
                                            $(this).siblings(".correcRes").show().html(html);
                                        }
                                        $(this).hide();
                                        answered++;
                                    }
                                    else{
                                      alert("something Wrong");
                                    }
                                }


                            })()
                       
                            if(answered == totalQuestion){
                               $(".resultcard").show();

                               $(".sTotal").html(totalQuestion);
                               $(".sScore").html(correct);

                            }

                        }
                    })
                })

                $(".BtnSubmitScore").click(function(){
                   let exam_id = <?= $exams[0]["exam_id"]; ?>;
                   let user_id = <?= $this->session->userdata("user_id");?>;
                   
                   let results = {
                       exam_id,
                       user_id,
                       totalItem: totalQuestion,
                       score: correct,   
                   }
                })


                function frmdta(obj){
 
 
                }
            </script>

        <?php
    }

?>


    </body>
</html>
