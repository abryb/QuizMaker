# QuizMaker
Making simple quizes to share.

Index.php displays 3 things depending on GET data. 

 1. If no data is send, show quiz create form, supported by JS with jQuery library.
 - after submitting, form data is send by AJAX to quizReceipt.php, which returns object of quiz.
 - than quiz 'code' and link to quiz is shown to user.
 2. If value of 'code' is send, index displays quiz created by server from quiz object.
  Form data is send to quizRezult, where object of solutions is created and save to DB.
  Than user is redirected to index with GET data of 'code' and 'solution'.
 3. If value of 'code' and 'solution' is send, index displays given quiz with result and style users answers using script.
