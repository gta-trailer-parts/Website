(function(){
  var t=document.querySelector('.menu-toggle'),n=document.getElementById('site-nav');
  if(!t||!n)return;
  t.addEventListener('click',function(){
    var o=n.classList.toggle('open');
    t.setAttribute('aria-expanded',o?'true':'false');
  });
})();
