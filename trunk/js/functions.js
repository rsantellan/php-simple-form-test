function checkQuestion(questionId)
{
    if(questionId > 15)
        return false;
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
    else
    {
        if($("#q1:checked").length > 0)
            ok--;
    }

    if(question.opciones[1].correcto == 1)
    {
        cantidadok++;
        if($("#q2:checked").length > 0)
        ok++;
    }
    else
    {
        if($("#q2:checked").length > 0)
            ok--;
    }

    if(question.opciones[2].correcto == 1)
    {
        cantidadok++;
        if($("#q3:checked").length > 0)
        ok++;
    }
    else
    {
        if($("#q3:checked").length > 0)
            ok--;
    }

    if(question.opciones[3].correcto == 1)
    {
        cantidadok++;
        if($("#q4:checked").length > 0)
        ok++;
    }
    else
    {
        if($("#q4:checked").length > 0)
            ok--;
    }
    //console.log(cantidadok);
    //console.log(ok);
    if(ok == cantidadok)
    {
        $("#semaforo").attr("src", "images/semaforo-verde.png");
        
    }
    if(ok > 0 && ok < cantidadok)
    {
        $("#semaforo").attr("src", "images/semaforo-amarillo.png");
    }
    if(ok <= 0)
    {
        $("#semaforo").attr("src", "images/semaforo-rojo.png");
    }


}

function doShowEndOfQuestions()
{
    $("#moveToNext").hide();
    changeGoodAnswerImage();
    //console.info(goodAnswers);
    $("#finalScore").fadeIn();
    if(goodAnswers == 15)
    {
        $("#finalScoreAllGood").fadeIn();
        $("#moveToForm").fadeIn();
        setTimeout(function(){
                window.location = "formulario.php";
                }, 30000);
    }
    else
    {
        $("#finalScoreNotGood").fadeIn();
        setTimeout(function(){
                window.location = "index.html";
                }, 30000);
    }
    
    return false;
}

function showQuestion(questionId)
{
    if(questionId > 15)
        return doShowEndOfQuestions();
    
    //$("#moveToNext").hide();
    
    if(questionId == 5)
    {
        $("#messageGoingOn").fadeOut(400, function(){
            $("#messageGoingOnImage").attr("src", "images/adelante.png");
            $("#moveToNext").removeClass('moveToNextAlternativePostion');
        });
    }
    if(questionId == 9)
    {
        $("#messageGoingOn").fadeOut(400, function(){
            $("#messageGoingOnImage").attr("src", "images/vas_bien.png");
            $("#moveToNext").removeClass('moveToNextAlternativePostion');
        });
    }
    if(questionId == 13)
    {
        $("#messageGoingOn").fadeOut(400, function(){
            $("#messageGoingOnImage").attr("src", "images/vamos_falta_poco.png");
            $("#moveToNext").removeClass('moveToNextAlternativePostion');
        });
    }
    if(questionId == 15)
    {
        $("#messageGoingOn").fadeOut(400, function(){
            $("#moveToNext").removeClass('moveToNextAlternativePostion');
        });
    }
    question = questionList[questionId];
    //console.info(question);
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
    
    //$("#moveToNext").fadeOut();
    checkQuestion(questionNumber);
    sendFormToServer();
    
    processing = false;
}

function nextQuestion()
{
    if(questionNumber == 4)
    {
        $("#moveToNext").addClass('moveToNextAlternativePostion');
        $("#messageGoingOn").fadeIn(1200, function(){
            $(this).fadeOut(1200, function(){
                $("#moveToNext").removeClass('moveToNextAlternativePostion');
            });
        });
    }
    if(questionNumber == 8)
    {
        $("#moveToNext").addClass('moveToNextAlternativePostion');
        $("#messageGoingOn").fadeIn(1200, function(){
            $(this).fadeOut(1200, function(){
                    $("#moveToNext").removeClass('moveToNextAlternativePostion');
            });
        });
    }
    if(questionNumber == 12)
    {
        $("#moveToNext").addClass('moveToNextAlternativePostion');
        $("#messageGoingOn").fadeIn(1200, function(){
            $(this).fadeOut(1200, function(){
                    $("#moveToNext").removeClass('moveToNextAlternativePostion');
            });
        });
    }
    if(questionNumber == 14)
    {
        $("#moveToNext").addClass('moveToNextAlternativePostion');
        $("#messageGoingOn").fadeIn(1200, function(){
            $(this).fadeOut(1200, function(){
                    $("#moveToNext").removeClass('moveToNextAlternativePostion');
            });
        });
    }
    //$("#messageGoingOn").hide();
    //$("#moveToNext").hide();
    clearCheckBoxes();
    questionNumber++;
    showQuestion(questionNumber);
}
function sendFormToServer()
{
    $.ajax({
      url: $("#question_form").attr('action'),
      data: $("#question_form").serialize(),
      type: 'post',
      dataType: 'json',
        success: function(json){
              //console.log(goodAnswers);
              if(json.response == "ok")
              {
                  goodAnswers = json.goodanswer;
                  changeGoodAnswerImage();
              }
              //console.log(goodAnswers);
        }
        , 
        complete: function()
        {
            setTimeout(function(){
                $("#semaforo").attr("src", "images/semaforo.png");
                clearCheckBoxes();
                $("#moveToNext").fadeIn();
                //questionNumber++;
                //showQuestion(questionNumber);
                
                }, 3000);
            
        }
      });   
}

function changeGoodAnswerImage()
{
    var imgsrc = "images/puntaje1_15.png";
    switch(goodAnswers)
    {
        case 0:
        case 1:
            imgsrc = "images/puntaje1_15.png";
        break;
        case 2:
            imgsrc = "images/puntaje2_15.png";
        break;
        case 3:
            imgsrc = "images/puntaje3_15.png";
        break;
        case 4:
            imgsrc = "images/puntaje4_15.png";
        break;
        case 5:
            imgsrc = "images/puntaje5_15.png";
        break;
        case 6:
            imgsrc = "images/puntaje6_15.png";
        break;
        case 7:
            imgsrc = "images/puntaje7_15.png";
        break;
        case 8:
            imgsrc = "images/puntaje8_15.png";
        break;
        case 9:
            imgsrc = "images/puntaje9_15.png";
        break;
        case 10:
            imgsrc = "images/puntaje10_15.png";
        break;
        case 11:
            imgsrc = "images/puntaje11_15.png";
        break;
        case 12:
            imgsrc = "images/puntaje12_15.png";
        break;
        case 13:
            imgsrc = "images/puntaje13_15.png";
        break;
        case 14:
            imgsrc = "images/puntaje14_15.png";
        break;
        case 15:
            imgsrc = "images/puntaje15_15.png";
        break;
    }
    $("#img_puntaje").attr("src", imgsrc);
}
