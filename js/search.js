jQuery(document).ready(function ($) {
    if (document.getElementById("search-icon")) {
        document.getElementById("search-icon").onclick = () => {
            document.getElementById("search-control").classList.toggle("show");
        };
    }
});
