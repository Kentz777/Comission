<?php include('db_connect.php'); ?>

<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="" id="manage-supply">
					<div class="card">
						<div class="card-header">
							PRODUCT FORM
						</div>
						<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Product Name</label>
								<input name="name" id="" class="form-control" required></input>
							</div>

							<div class="form-group">
								<label class="control-label">Product Description</label>
								<textarea name="description" id="" cols="30" rows="5" style="resize: none;" class="form-control" required></textarea>
							</div>

							<div class="form-group">
								<label class="control-label">Category </label>
								<select name="category_id" id="" class="custom-select browser-default">
									<?php
									$cat = $conn->query("SELECT * FROM laundry_categories order by name asc ");
									while ($row = $cat->fetch_assoc()) :
									?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php endwhile; ?>
								</select>

							</div>

							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" id="priceInput" class="form-control text-right" min="1" max="99999" step="any" name="price" required>
							</div>

							<div class="form-group">
								<label for="" class="control-label">Image</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>

							<div class="form-group">
								<img src="<?php echo isset($image_path) ? '../assets/img/' . $cover_img : '' ?>" alt="" id="cimg" required>
							</div>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
									<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-supply').get(0).reset()"> Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Img</th>
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$cats = $conn->query("SELECT * FROM supply_list order by id asc");
								while ($row = $cats->fetch_assoc()) :
								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>
										<td class="text-center">
											<img src="<?php echo isset($row['img_path']) ? './assets/img/' . $row['img_path'] : '' ?>" alt="" id="cimg">
										</td>
										<td class="">
											<p>Name : <b><?php echo $row['name'] ?></b></p>
											<p>Description : <b class="truncate"><?php echo $row['description'] ?></b></p>
											<p>Price : <b><?php echo "P" . number_format($row['price'], 2) ?></b></p>

										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-primary edit_supply" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-price="<?php echo $row['price'] ?>" data-description="<?php echo $row['description'] ?>" data-img_path="<?php echo $row['img_path'] ?>">Edit</button>
											<button class="btn btn-sm btn-danger delete_supply" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	img#cimg,
	.cimg {
		max-height: 10vh;
		max-width: 6vw;
	}

	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-supply').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_supply',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully added", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				} else if (resp == 2) {
					alert_toast("Data successfully updated", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	})
	$('.edit_supply').click(function() {
		start_load()
		var cat = $('#manage-supply')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("#cimg").attr('src', './assets/img/' + $(this).attr('data-img_path'))
		end_load()
	})
	$('.delete_supply').click(function() {
		_conf("Are you sure to delete this supply?", "delete_supply", [$(this).attr('data-id')])
	})

	function delete_supply($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_supply',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}

	$(document).ready(function() {
		$('#priceInput').on('input', function() {
			var price = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'validatePrice.php',
				data: {
					price: price
				},
				success: function(response) {
					if (response.error) {
						$("#error-message").text(response.message);
					} else {
						$("#error-message").text("");
					}
				}
			})
		})
	});
</script>