# QuizMaker
Making simple quizes.

Index.php displays 3 things depending on GET data. 

1. If no data is send, show quiz create form, supported by JS with jQuery library. <br>
 - after submitting form data is send by AJAX to quizReceipt.php, which returns obcjet of quiz.
 - than quiz code and link is show to user
 2. If value of 'code' is send, 
