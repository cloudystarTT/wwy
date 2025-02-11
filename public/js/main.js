// // $(document).ready(function() {
// //     $('.table').DataTable();
// // });

// // Toggle sidebar visibility when clicking on the bi-list icon

document.getElementById('menu').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
    // console.log("hadfyiwdy")
});

// // document.addEventListener('DOMContentLoaded', function() {
// //     var element = document.getElementById('sideToggle');
// //     if (element) {
// //         element.addEventListener('click', function() {
// //             document.getElementById('sidebar').classList.toggle('open');
// //             document.getElementById('overlay').classList.toggle('active');
// //             // Your event handler code here
// //         });
// //     }
// // });

// // Close sidebar when clicking on the overlay

document.getElementById('overlay').addEventListener('click', function() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('active');
});

// // document.addEventListener('DOMContentLoaded', function() {
// //     var element = document.getElementById('sideToggle');
// //     if (element) {
// //         element.addEventListener('click', function() {
// //             document.getElementById('sidebar').classList.remove('open');
// //             document.getElementById('overlay').classList.remove('active');
// //             // Your event handler code here
// //         });
// //     }
// // });