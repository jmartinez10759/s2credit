<!DOCTYPE html>
<html>
<head>
	<title>Menu Crud</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="page-header">Menus</h1>
		<div class="well well-sm text-right">
		    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			  Nuevo Menu
			</button>
		</div>

		<table class="table table-striped">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>Nombre</th>
		            <th>Submenu</th>
		            <th>Descripcion</th>
		            <th>Status</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($menus as $m): ?>
			        <tr>
			            <td><?php echo $m['id']; ?></td>
			            <td><?php echo $m['name']; ?></td>
			            <td><?php echo $m['submenu']; ?></td>
			            <td><?php echo $m['description']; ?></td>
			            <td><?php echo ($m['status'])? "Activo": "Inactivo"; ?></td>
			            <td>
			                <button class="btn btn-info" type="button" onclick="edit(<?php echo $m['id']; ?>)">Editar</button>
			                <button class="btn btn-danger" type="button" onclick="destroy(<?php echo $m['id']; ?>)">Borrar</button>
			            </td>
			        </tr>
			    <?php endforeach; ?>
		    </tbody>
		</table> 	
	</div>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Crear Menu</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<form>
			  <div class="form-group">
			    <label for="menu">Menu Padre</label>
			    <input type="text" class="form-control" id="name" placeholder="Nombre menu">
			    <input type="hidden" class="form-control" id="menu_id">
			  </div>

			  <div class="form-group">
			    <label for="submenu">Sub Menu</label>
			    <input type="text" class="form-control" id="submenu">
			  </div>

			  <div class="form-group">
			    <label for="description">Descripcion</label>
			    <textarea class="form-control" id="description" rows="3"></textarea>
			  </div>

			</form>

	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
		
		function save() {

			let name 		= $('#name').val();
			let description = $('#description').val();
			let submenu 	= $('#submenu').val();
			let menu_id 	= $('#menu_id').val();
			if (!name) {
				return alert("Favor de agregar Nombre Menu");;
			}
			let fields = {
				'name' : name,
				'description' : description,
				'submenu' : submenu
			}
			console.log(menu_id);
			$.ajax({
					type: "POST",
					url: (!menu_id)?"index.php": "index.php?update="+menu_id,
					data: fields,
					success: function(datos){
					   $('#exampleModal').modal('hide');
					   location.reload();
				  }
			});

		}

		function destroy(id){
			$.ajax({
					type: "POST",
					url: "index.php?delete="+id,
					data: {},
					success: function(datos){
					   location.reload();
				  }
			});
		}

		function edit(id){

			$.ajax({
					type: "GET",
					url: "index.php",
					data: {'id' : id},
					success: function(datos){
						let json = JSON.parse(datos);
					    $('#name').val(json.name);
						$('#description').val(json.description);
						$('#submenu').val(json.submenu);
						$('#menu_id').val(json.id);
						$('#exampleModal').modal('show');
				  }
			});
		}


	</script>

</body>
</html>