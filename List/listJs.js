$(document).ready(function() {
		var list = document.getElementById('list');
		console.log("Eigentlich mache ich jetzt was");
		$("#saveList").on('click', function(e) {
			console.log("Eigentlich mache ich jetzt was");
			e.preventDefault();
			localStorage.setItem('todoList', list.innerHTML);
			alertify.success("You have saved your list.");
		});
		$("#clearList").on('click', function(e) {
			console.log("Eigentlich mache ich jetzt was");
			e.preventDefault();
			localStorage.clear();
			location.reload();
		});
		
		loadToDo();
		
		function loadToDo() {
		  if (localStorage.getItem('todoList')){
			list.innerHTML = localStorage.getItem('todoList'); 
		}
	}
});