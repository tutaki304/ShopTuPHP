
const itemslidebar = document.querySelectorAll(".danhmuc-left-li");
itemslidebar.forEach(function(menu,index){
    menu.addEventListener("click",function(){
        menu.classList.toggle("block")
    })
})
// ---------------------img----------------
const bigImg = document.querySelector(".product-content-left-big-img img")
const smalImg = document.querySelectorAll(".product-content-left-small-img img")
smalImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click",function(){
        bigImg.src = imgItem.src
    })
})
function tongtien(){
    var dssanpham = document.querySelectorAll('table tbody tr');
    var tongtien = document.querySelector('#khuyenmai').value; 
    for(const sanpham of dssanpham){
        var gia = sanpham.querySelector('td:nth-child(4)').innerText.replace('đ','');
        var tien = gia * tongtien;
        sanpham.querySelector('td:nth-child(6)').innerText = tien+'đ';
        tong = tong + tien;
    }
    document.querySelector('tfoot th:nth-child(2)').innerText = tong+'đ';
}
