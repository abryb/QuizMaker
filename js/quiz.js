
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
    addQuest.on('click', function (e) {
        //single question div
        var question = $('<div data-qst="' + questCount + '"><label style="font-size: 1.8rem;">Question ' + questCount + ':<textarea cols="70" class="form-control" name="question"></textarea></label><button display="block" type="submit" class="addAnswer btn">Add answer</button></div><hr>');

        var ansCount = 1;
//        var currQuestCount = questCount;
        //setting event on add answer button
        question.on('click', '.addAnswer', function (e) {
            e.preventDefault();
            var answer = $('<label>Answer ' + ansCount + ' (check if correct): <input type="checkbox" name="correct" value="true"><input data-ans ="' + ansCount + '"type="text" class="form-control" name="answer"></label>');
            answer.insertBefore($(this));
            ansCount++;
        });

        e.preventDefault();
        questionsDiv.append(question);
        questCount++;
    });


    sendBtn.on('click', function (e) {
        e.preventDefault();
        //seting objcet to send
        var quizObj = {};

        //getting quiz name
        var quizName = form.find('#name');
        var quizDesc = form.find('#description');

        //setting quizObj properties
        quizObj.name = quizName.val();
        quizObj.descr = quizDesc.val();
        quizObj.questions = [];
        quizObj.answers = [];
        quizObj.correct = [];


        // !!! geting quiz questions and answers
        var quizQuestionsDivs = questionsDiv.children('div');
        quizQuestionsDivs.each(function (index, value) {
            $(value).each(function (index, value) {
                var question = $(value).find('textarea').val();
                quizObj.questions.push(question);

            });
            console.log(quizObj);
        });




//        $.ajax({
//           url: 'api/quizReceipt.php',
//           data: quizObj,
//           dataType: 'json',
//           type: 'POST'
//        }).done(function(result) {
//            console.log(result);
//        }).fail(function(){
//            console.log('Error');
//        });
    });


});