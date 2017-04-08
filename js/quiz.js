
$(function () {

    //Define variables ----------------------------------------------------------
    var form = $('form'); //FORM jQ obcjet
    var addQuest = form.find('#addQuest'); //ADD QUESTION Btn 
    var questionsDiv = form.find('#questions'); //QUESTIONS div
    var sendBtn = form.find('#submit'); //SEND Quiz Btn
    //-------------------------------------------------------------------------

    //event on add question button 
    var questCount = 1; //counter of questions    
    addQuest.on('click', function (e) {
        e.preventDefault();
        //single question div
        var question = $('<div class="question" data-qst="' + questCount + '"><label style="font-size: 1.8rem;">Question ' + questCount + '<span title="control"></span>:<textarea maxlength="300" cols="70" class="form-control" name="question"></textarea></label><button display="block" type="submit" class="addAnswer btn">Add answer</button></div><hr>');

        //setting event on add answer button
        var ansCount = 1;
        question.on('click', '.addAnswer', function (e) {
            e.preventDefault();
            var answer = $('<label><span title="control"></span>Answer ' + ansCount + ' (check if correct): <input type="checkbox" name="correct"><input maxlength="60" data-ans ="' + ansCount + '"type="text" class="form-control" name="answer"></label>');
            //event on checkbox, label turns green if checked
            answer.find('input[type="checkbox"]').on('click', function() {
                if ($(this).is(":checked")) {
                    $(this).parent().css('color', 'green');
                } else {
                    $(this).parent().css('color', 'black');
                }
            });
            answer.insertBefore($(this));
            ansCount++;
        });
        questionsDiv.append(question);
        questCount++;
    });

    //--------------------------------------------------------------------------
    // SENDING quiz event
    sendBtn.on('click', function (e) {
        e.preventDefault();
        //validate, (function below)
        if (checkInputs() === true) {
            //seting objcet to send
            var quizObj = {};

            //setting quizObj properties
            quizObj.name = form.find('#name').val();
            quizObj.descr = form.find('#description').val();
            quizObj.questions = [];
            quizObj.answers = [];
            quizObj.correct = [];

            // Divs with question and answers
            var quizQuestionsDivs = questionsDiv.children('div');
            //variable for counting questions, and setting index in array of answers and correct
            var qstCount = 0;

            //iterating 
            quizQuestionsDivs.each(function (index, singleDiv) { //singleDiv is div with one question and answers to it

                //getting quiz questions
                var question = $(singleDiv).find('textarea').val();
                quizObj.questions.push(question);

                //getting quiz answers
                quizObj.answers[qstCount] = [];
                var answers = $(singleDiv).find('input[name="answer"]');
                //pushing answers to array
                answers.each(function (index, ans) {
                    quizObj.answers[qstCount].push($(ans).val());
                });

                //getting quiz correct answers
                quizObj.correct[qstCount] = [];
                var corrects = $(singleDiv).find('input[type="checkbox"]');
                corrects.each(function (index, cor) {
                    quizObj.correct[qstCount].push($(cor).is(":checked")); // push boolean value, if is checked or not
                });
                qstCount++;
            });
            //Validate
            // AJAX sending quizObj -----------------
            $.ajax({
                url: 'api/quizReceipt.php',
                data: quizObj,
                dataType: 'json',
                type: 'POST'
            }).done(function (result) {
                sendBtn.off().on('click', function (e) {
                    e.preventDefault();
                });
                window.scrollTo(0, 0);
                var doneDiv = $('<div class="row"><h2>Your code is: ' + result + '</h2><h2> Link: <a href="?code=' + result + '">quizMaker?code=' + result + '</a></h2></div><br>');
                doneDiv.insertBefore(form);
            }).fail(function () {
                console.log('Error');
            });
        } 
    });
    //--------------------------------------------------------------------------
    //CHEKING/VALIDATE FUNCTION
    function checkInputs() {
        var spanControl = form.find('span[title="control"]');
        var toReturn = true;
        spanControl.each(function (index, value) {
            var input = $(this).parent().children('input[type="text"], textarea');
            if (input.val().length <= 0) {
                $(this).text(' this can\'t be empty ').css('color', 'red');
                toReturn = false;
                
            } else {
                $(this).text('');
            }
        });
        return toReturn;
    }
});
