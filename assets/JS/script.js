// رسالة ترحيب عند فتح الموقع
window.onload = function () {
    console.log("تم تشغيل نظام إدارة المعاملات");
};

// تلوين الصف المحدد في الجدول عند الضغط عليه
const rows = document.querySelectorAll("tbody tr");

rows.forEach((row) => {
    row.addEventListener("click", () => {

        rows.forEach((r) => {
            r.style.background = "";
        });

        row.style.background = "#dff5e3";
    });
});



// عرض تاريخ اليوم

const today = new Date();

const options = {
    year: "numeric",
    month: "long",
    day: "numeric"
};

const dateElement = document.getElementById("date");

if(dateElement){

    dateElement.innerHTML =
    today.toLocaleDateString("ar-SA",options);

}