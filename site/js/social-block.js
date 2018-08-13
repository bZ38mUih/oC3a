$(document).ready(function(){
    $('.social_share').click(function(){
        var dataType = $(this).attr('data-type');
        var shareUrl=null;
        var shareImg=null;
        if($("#shareImg").length==1){
            shareImg = 'http://'+location.hostname+$("#shareImg").attr('src');
        }else{
            shareImg = 'http://'+location.hostname+'/'+$(".imgBlock img").attr('src');
        }
        switch (dataType){
            case 'ok':
                shareUrl="https://connect.ok.ru/offer?url="+location.href+"&title="+document.title
                +"&description="+$('meta[name=description]').attr("content")
                +"&imageUrl="+shareImg;
                break;
            case 'vk':
                shareUrl='http://vk.com/share.php?'
                +'url='+ location.href
                +'&image='+shareImg
                +'&title='+ $('meta[name=description]').attr("content")
                +'&noparse=true';
                break;
            case 'fb':
                shareUrl="http://www.facebook.com/sharer.php?s=100"+ '&p[url]='+ location.href;
                break;
        }
        return window.open(shareUrl,'','toolbar=0,status=0,scrollbars=1,width=626,height=436');
    });
    countShare();

    /*yandex metrika-->*/
    /*
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter44136454 = new Ya.Metrika({
                    id:44136454,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    */
})

function countShare() {
    $.get('?shareCount', function (data) {
        var obj = JSON.parse(data);
        for(var key in obj){
            if(obj.hasOwnProperty(key)){
                if(obj[key]>0){
                    //alert(obj[key]+" / "+key);
                    //$("a.social_share [data-type='"+key+"']").html(obj[key]);
                    $("[data-type='"+key+"'] sup").html(obj[key]);
                }
            }
        }
    });
}