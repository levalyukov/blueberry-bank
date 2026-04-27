const full = "h-screen w-xs bg-slate-50 px-6 py-8 border-r-1 border-slate-300 flex flex-col shrink-0";
const short = "h-screen w-25 bg-slate-50 px-6 py-8 border-r-1 border-slate-300 flex flex-col shrink-0";

function navmenu () 
{
    const aside = document.getElementById("navmenu");

    if (aside) {
        const data = localStorage.getItem("navmenu");
        if (data) {
            const prev = JSON.parse(data);
            localStorage.setItem("navmenu", JSON.stringify({short:!prev.short}))
            const current = JSON.parse(data);
            (!current.short) ? aside.setAttribute("class", short) : aside.setAttribute("class", full);
        } else {
            aside.setAttribute("class", full);
            localStorage.setItem("navmenu", JSON.stringify({short: false}));
        }
    }
}

window.onload = () => {
    const aside = document.getElementById("navmenu");

    if (aside) {
        const data = localStorage.getItem("navmenu");
        if (data) {
            const current = JSON.parse(data);
            (current.short) ? aside.setAttribute("class", short) : aside.setAttribute("class", full);
        } else {
            aside.setAttribute("class", full);
            localStorage.setItem("navmenu", JSON.stringify({short: false}));
        }
    }
}