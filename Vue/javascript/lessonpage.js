const icon_menu= document.querySelector(".icon_toggle"),
        nav= document.querySelector("nav"),
        body=document.querySelector("body"),
        toggle_switch=document.querySelector("div.toggle-switch"),
        btn_list_diapos_left=document.querySelector(".btn_list_diapos_left"),
        btn_list_videos_left=document.querySelector(".btn_list_videos_left"),
        btn_list_diapos_right=document.querySelector(".btn_list_diapos_right"),
        btn_list_videos_right=document.querySelector(".btn_list_videos_right"),
        list_diapos=document.querySelector("div.list_diapos");

icon_menu.addEventListener("click",() =>
{
    nav.classList.toggle("menu_sidebar");

});
toggle_switch.addEventListener("click",() =>
{
    body.classList.toggle("dark");
});

btn_list_diapos_left.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft +=500;
    console.log(scroll.scrollLeft);
});
btn_list_videos_left.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_videos");
    if (scroll.scrollLeft <= scroll.scrollWidth )
    {
        scroll.scrollLeft +=500;
        console.log(scroll.scrollLeft);
    }
});

btn_list_diapos_right.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft -=500;
    console.log(scroll.scrollLeft);
});
btn_list_videos_right.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_videos");
    if (scroll.scrollLeft >= 0 )
    {
        scroll.scrollLeft -=500;
        console.log(scroll.scrollLeft);
    }
});