<?php
include "config.php";
$hasil = mysqli_query($koneksi, "select * from tbkuesioner order by id_kuesioner");
$jumlah = mysqli_num_rows($hasil);
$urut = 0;
while ($row = mysqli_fetch_array($hasil)) {
	$urut = $urut + 1;
	$id_kuesioner = $row["id_kuesioner"];
	$pertanyaan = $row["pertanyaan"];
	$pila = $row["pila"];
	$pilb = $row["pilb"];
	$pilc = $row["pilc"];
	$pild = $row["pild"];
	$pile = $row["pile"];

?>
	<div class="box-content">
		<form name="form1" method="post">

			<input type="hidden" name="id[]" value=<?php echo $id_kuesioner; ?>>
			<input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
			<table class="table">
				<tr>
					<td><?php echo $urut; ?></td>
					<td><?php echo "$pertanyaan"; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="radio" name="pilihan[<?php echo $id_kuesioner; ?>]" value="A">A. <?php echo "$pila"; ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="pilihan[<?php echo $id_kuesioner; ?>]" type="radio" value="B">B. <?php echo "$pilb"; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="pilihan[<?php echo $id_kuesioner; ?>]" type="radio" value="C">C. <?php echo "$pilc"; ?> </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="pilihan[<?php echo $id_kuesioner; ?>]" type="radio" value="D">D. <?php echo "$pild"; ?> </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="pilihan[<?php echo $id_kuesioner; ?>]" type="radio" value="E">E. <?php echo "$pile"; ?> </td>
				</tr>

			<?php

		}
			?>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
			</tr>
		</form>
		</table><?php
				if (isset($_POST['submit'])) {
					mysqli_query($koneksi, "DELETE FROM jawaban");
					$pilihan = $_POST["pilihan"];
					$id_kuesioner = $_POST["id"];
					$jumlah = $_POST['jumlah'];

					$score = 0;
					$benar = 0;
					$salah = 0;
					$kosong = 0;
					$jum = count($pilihan);
					if ($jum < $jumlah) {
				?>
				<script type="text/javascript">
					alert("Maaf anda belum mengisi secara lengkap, mohon diisi secara lengkap");
					history.back();
				</script>
		<?php
					} else {
						for ($i = 0; $i < $jum; $i++) {
							//id nomor soal
							$nomor = $id_kuesioner[$i];

							//jika user tidak memilih jawaban
							if (empty($pilihan[$nomor])) {
								$jawaban = '';
							} else {
								//jawaban dari user
								$jawaban = $pilihan[$nomor];
							}
							mysqli_query($koneksi, "insert into jawaban (id_kuesioner,jawaban)
								values ('$nomor','$jawaban')                                    
								") or die(mysqli_error($koneksi));
						}
					}
				}
		?>