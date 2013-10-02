function checkQuestion(questionId)
{
    question = questionList[questionId];
    //console.info(question);
    var ok = 0;
    var cantidadok = 0;
    if(question.opciones[0].correcto == 1)
    {
        cantidadok++;
        if($("#q1:checked").length > 0)
        ok++;
    }

    if(question.opciones[1].correcto == 1)
    {
        cantidadok++;
        if($("#q2:checked").length > 0)
        ok++;
    }

    if(question.opciones[2].correcto == 1)
    {
        cantidadok++;
        if($("#q3:checked").length > 0)
        ok++;
    }

    if(question.opciones[3].correcto == 1)
    {
        cantidadok++;
        if($("#q4:checked").length > 0)
        ok++;
    }
    if(ok == cantidadok)
    {
        $("#semaforo").attr("src", "images/semaforo-verde.png");
        
    }
    if(ok > 0 && ok < cantidadok)
    {
        $("#semaforo").attr("src", "images/semaforo-amarillo.png");
    }
    if(ok == 0)
    {
        $("#semaforo").attr("src", "images/semaforo-rojo.png");
    }


}

function showQuestion(questionId)
{
    question = questionList[questionId];
    console.info(question);
    //console.info(question['pregunta']);
    //console.info(question.pregunta);
    $("#questionNumber").val(questionId);
    $("#questionText").html(question.pregunta);
    resizeTextOfId('questionText', 24, 29);
    $("#answerText1").html(question.opciones[0].texto);
    resizeTextOfId('answerText1', 16, 22);
    $("#answerText2").html(question.opciones[1].texto);
    resizeTextOfId('answerText2', 16, 22);
    $("#answerText3").html(question.opciones[2].texto);
    resizeTextOfId('answerText3', 16, 22);
    $("#answerText4").html(question.opciones[3].texto);
    resizeTextOfId('answerText4', 16, 22);


}

function resizeTextOfId(elementId, startFontSize, minFontSize)
{
    //return false;
    var elementUsed = $('#'+elementId);
    var maxWidth = elementUsed.parent().width();
    var fontSize = startFontSize;

    do {
        fontSize++;
        elementUsed.css('font-size', fontSize.toString() + 'px');
        //console.info(elementUsed.width());
        //console.info(maxWidth);
    } while ( (elementUsed.width()) < maxWidth && fontSize < minFontSize );
    if(fontSize <= 22)
    {
        fontSize --;
        elementUsed.css('font-size', fontSize.toString() + 'px');
    }
}

function clearCheckBoxes()
{
    $('#question_form').find(':checked').each(function() {
        $(this).removeAttr('checked');
    });
}

var processing = false;

function checkSendAndSaveQuestion()
{
    if(processing)
        return false;
    processing = true;
    checkQuestion(questionNumber);
    sendFormToServer();
    
    processing = false;
}

function sendFormToServer()
{
    $.ajax({
      url: $("#question_form").attr('action'),
      data: $("#question_form").serialize(),
      type: 'post',
      dataType: 'json',
        success: function(json){
              console.log(goodAnswers);
              if(json.response == "ok")
              {
                  goodAnswers++;
              }
              console.log(goodAnswers);
        }
        , 
        complete: function()
        {
            setTimeout(function(){
                $("#semaforo").attr("src", "images/semaforo.png");
                clearCheckBoxes();
                questionNumber++;
                showQuestion(questionNumber);
                }, 3000);
            
        }
      });   
}
