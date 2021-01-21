const myTitreHtml=document.querySelector('h1');
myTitreHtml.style.position="absolute";

let myTopPosition=0;
let myDirection=-1;
let myNewPosition='';

function myHorizontalSlide(){
    if(myTopPosition==1700){
        myTopPosition=-900
    }
    {myDirection=-1}
    myTopPosition+=-2*myDirection;
    myTitreHtml.style.left=myTopPosition+'px';
    requestAnimationFrame(myHorizontalSlide);
}

requestAnimationFrame(myHorizontalSlide);