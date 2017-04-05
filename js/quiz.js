
$(function () {
    //FORM jQ obcjet
    var form = $('form');
    
    //ADD QUESTION Btn 
    var addQuest = form.find('#addQuest');
    
    //QUESTIONS div
    var questionsDiv = form.find('#questions');
    
    //SEND Quiz Btn
    var sendBtn = form.find('#submit');
    
    //event on add question button 
    var questCount = 1; //counter of questions    
    addQuest.on('click', function(e){         
        //single question div
        var question = $('<div data-id="quest'+questCount+'"><label style="font-size: 1.8rem;">Question '+questCount+':<textarea cols="50" class="form-control" name="question'+questCount+'"></textarea></label><button display="block" type="submit" class="addAnswer btn">Add answer</button></div><hr>');     
        
        var ansCount = 1;
        var currQuestCount = questCount;
        //event on button
        question.on('click','.addAnswer', function(e){
            e.preventDefault();
            var answer = $('<label>Answer '+ansCount+' (check if correct): <input type="checkbox" name="corrquest'+currQuestCount+'is'+ansCount+'" value="true"><input type="text" class="form-control" name="quest'+currQuestCount+'ans'+ansCount+'"></label>');
            answer.insertBefore($(this));
            ansCount++;
        });
        
        e.preventDefault();
        questionsDiv.append(question);
        questCount++;
    });
    
    sendBtn.on('click', function(e) {
        e.preventDefault();
        var quizObj = {};
        // !!! geting quiz input values
        $.ajax({
           url: 'api/quizReceipt.php',
           data: quizObj,
           dataType: 'json',
           type: 'POST'
        }).done(function(result) {
            console.log(result);
        }).fail(function(){
            console.log('Error');
        });
    })
    
    
});