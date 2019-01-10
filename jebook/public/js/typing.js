
const message = "Jebook 一个渴望与行动的结果。N" +
    "在每一个孤独的夜晚，你们是否想过要写一本书，或者记录一下自己的生活又或者是写写小说？N" +
    "在苦思眠想得到一个令人兴奋的结果后，作为程序员的你，是否想过有一个自己的博客记录分享自己的经验？N" +
    "当面试官问你是否拥有一个属于自己的博客的时候，你是否后悔过自己没有？N" +
    "此时，Jebook 就是为了解决这些问题而来的。N" +
    "Jebook 一个简洁快捷的创作平台。不管你是哪行那业的人，只要你敢写你就会写，只要你敢用你就会觉得好用。N" +
    "Jebook 只要注册登陆后即可创建自己的博客书籍，并拥有属于自己的专属域名。N";

const container = document.querySelector('#about');

let n;

function rerun(){
    container.textContent = '';
    n = 0;
    typist(message, container);
};

rerun();
function interval(letter){
    //console.log(letter);
    if(letter == ';' || letter == '.' || letter == ','){
        return Math.floor((Math.random() * 500) + 500);
    } else {
        return Math.floor((Math.random() * 150) + 5);
    }
}

function typist(text, target){
    if(typeof(text[n]) != 'undefined'){
        if(text[n] == 'N'){
            target.innerHTML += '<br/>';
        }else if(text[n] == ' '){
            target.innerHTML += '&nbsp';
        }else {
            target.innerHTML += text[n];
        }
    }
    n++;
    if(n < text.length){
        setTimeout(function(){
            typist(text, target)
        }, interval(text[n - 1]));
    }
}
