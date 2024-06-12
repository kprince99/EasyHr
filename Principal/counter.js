//Counter//
$({Counter:0}).animate(
  {Counter:$('.single').text()
    },{duration:1500,easing:'swing',
     step:function(){$('.single').text(Math.ceil(this.Counter));
   }});

$({Counter:0}).animate({Counter:$('.second').text()}
   ,{duration:1500,easing:'swing',
   step:function()
   {$('.second').text(Math.ceil(this.Counter));
 }});

    $({Counter:0}).animate({
        Counter:$('.third').text()},{duration:1500,easing:'swing'
    ,step:function()
    {$('.third').text(Math.ceil(this.Counter));
     }});
