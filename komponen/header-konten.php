<div id="header" class="p-2">
	<!-- button -->
	<button class="bars btn" onclick="myFunction()"><i class="fas fa-bars text-white"></i></button>

	<div class="kanan mt-2">

		<span class="profile text-decoration-none ms-2">
			<span class="pe-2"><?php echo ucwords(strtolower($sessionNama));?></span> 
			|
			<span class="mx-2">
				<span id="jam" class="bg-success rounded p-1"></span> :
				<span id="menit" class="bg-success rounded p-1"></span> :
				<span id="detik" class="bg-success rounded p-1"></span>
				&nbsp WIB
			</span>
			|
			<a class="logout text-decoration-none text-white px-2" href="logout.php"><i class="fa fa-sign-out-alt"></i> Log Out </a>
		</span>
	</div>
</div>