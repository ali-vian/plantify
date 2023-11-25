<?php
require_once('base.php');


//------------------------------- Customer ------------------------------------------

//------------------------------- Profile ------------------------------------------

// fungsi query untuk mendapatkan data diri customer 
function getDataDiri($username)
{
	try {
		$statement = DB->prepare("SELECT * FROM customer WHERE username = :username");
		$statement->bindValue(":username",$username);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// --------------------------- end Profile ----------------------------------------

// fungsi query untuk mendapatkan 4 produk terbaru
function getNewProducts()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk p JOIN kategori k ON p.id_kategori = k.id_kategori
		ORDER BY created_at DESC LIMIT 4");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan 4 produk yang diorder paling banyak
function getPopularProducts()
{
	try {
		$statement = DB->prepare("SELECT *,sum(jumlah_produk) 
		AS jml FROM order_detail od JOIN produk p ON od.id_produk = p.id_produk JOIN kategori k ON p.id_kategori = k.id_kategori
		GROUP BY od.id_produk ORDER BY jml DESC LIMIT 4");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllDataProductsBySearch($keyword)
{
	try {
		$statement = DB->prepare("SELECT * FROM produk p JOIN kategori k ON p.id_kategori = k.id_kategori
		WHERE LOWER(nama_produk) LIKE LOWER(:keyword) OR LOWER(nama_kategori) LIKE LOWER(:keyword)");
		$statement->bindValue(':keyword',"%$keyword%");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}	
}

function getDataProductById($id)
{
	try {
		$statement = DB->prepare("SELECT * FROM produk WHERE id_produk = :id");
		$statement->bindValue(":id",$id);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data produk
function getAllDataProductsWithCategory()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk p JOIN kategori k ON p.id_kategori = k.id_kategori");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data kategori
function getAllCategories()
{
	try {
		$statement = DB->prepare("SELECT k.id_kategori,nama_kategori,gambar_produk  FROM produk p 
		JOIN kategori k ON p.id_kategori = k.id_kategori GROUP BY p.id_kategori");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data produk berdasarkan kategori
function getAllDataProductsWithDetailsByCategory($kodeKat)
{
	try {
		$statement = DB->prepare("SELECT * FROM produk JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE produk.id_kategori = :kodeKat");
		$statement->bindValue(':kodeKat', $kodeKat);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi untuk mendapatkan keranjang customer
function getKeranjang($username)
{
	try{
		$statement = DB->prepare("SELECT kd.id_produk,kd.id_keranjang,nama_produk,harga_produk,stok_produk,gambar_produk, count(*) as jml FROM keranjang_detail kd JOIN produk p ON kd.id_produk = p.id_produk JOIN keranjang k ON k.id_keranjang = kd.id_keranjang WHERE username = :username GROUP BY id_produk");
		$statement->bindValue(':username',$username);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $err) 
	{
		echo $err->getMessage();
	}
}

// fungsi untuk mendapatkan id keranjang customer dan menambahkan ke database
function getCartCode($username)
{
	try {
		// mengambil id_keranjang dari customer 
		$statement = DB->prepare("SELECT id_keranjang FROM keranjang WHERE username = :username");
		$statement->bindValue(':username', $username);
		$statement->execute();
		if($statement->rowcount() > 0)  // jika query ada maka return id_keranjang
		{
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		else{   //jika query tidak ada maka insert ke table keranjang lalu ambil id_keranjang
			$statement1 = DB->prepare("INSERT INTO keranjang (username) VALUES (:username)");
			$statement1->bindValue(':username', $username);
			$statement1->execute();
			$statement = DB->prepare("SELECT id_keranjang FROM keranjang WHERE username = :username");
			$statement->bindValue(':username', $username);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menambahkan keranjang
function insertCart($username, $id_produk)
{
	$id_keranjang = getCartCode($username); //funsi untuk mendapatkan id_keranjang
	try {
		$statement = DB->prepare("INSERT INTO keranjang_detail(id_keranjang,id_produk) VALUES (:id_keranjang,:id_produk)");
		$statement->bindValue(':id_keranjang', $id_keranjang['id_keranjang']);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menghapus produk di keranjang
function deleteProductInCart($id_produk, $id_keranjang,$hapus)
{
	if($hapus===0){
		$query = "DELETE FROM keranjang_detail WHERE id_keranjang=:id_keranjang AND id_produk=:id_produk ORDER BY id_keranjang_detail DESC LIMIT 1";
	}elseif($hapus===1){
		$query = "DELETE FROM keranjang_detail WHERE id_keranjang=:id_keranjang AND id_produk=:id_produk ORDER BY id_keranjang_detail";
	}
	try {
		$statement = DB->prepare($query);
		$statement->bindValue(':id_keranjang', $id_keranjang);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi untuk menambah produk di keranjang
function increaseProductInCart($id_produk, $id_keranjang)
{
	try {
		$statement = DB->prepare("INSERT INTO  keranjang_detail(id_keranjang,id_produk) VALUES (:id_keranjang,:id_produk)");
		$statement->bindValue(':id_keranjang', $id_keranjang);
		$statement->bindValue(':id_produk', $id_produk);
		$statement->execute();

		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan nama bank 
function getAllBank()
{
	try {
		$statement = DB->prepare("SELECT * FROM bank");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menambahkan order ke database
function insertOrder($username,$total,$rekening,$bank,$id_keranjang)
{
	try {
		$statement = DB->prepare("INSERT INTO `order` (username,total_order,id_bank,no_rekening) 
		VALUES (:username,:total_order,:id_bank,:no_rekening)");
		$statement->execute(array(':username' => $username,
								':total_order'=> $total,
								':id_bank' => $bank,
								':no_rekening'=> $rekening
							));
		
		$id = DB->lastInsertId();
		$stat1 = DB->prepare("DELETE FROM keranjang_detail WHERE id_keranjang = :id_keranjang");
		$stat1->execute(array(':id_keranjang' => $id_keranjang));
		$stat2 = DB->prepare("DELETE FROM keranjang WHERE id_keranjang = :id_keranjang");
		$stat2->execute(array(':id_keranjang' => $id_keranjang));

		return $id;


	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menambahkan ke order detail
function insertOrderDetail($id_order,$id_produk,$jumlah,$total_harga)
{
	try {
		$statement = DB->prepare("INSERT INTO `order_detail` (id_order,id_produk,jumlah_produk,harga_total) 
		VALUES (:id_order,:id_produk,:jumlah,:total_harga)");
		$statement->execute(array(':id_order' => $id_order,
								':id_produk'=> $id_produk,
								':jumlah' => $jumlah,
								':total_harga' => $total_harga,
		));
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan data order dari customer
function getOrder($username)
{
	try {
		$statement = DB->prepare("SELECT id_order,tanggal_order,total_order,no_rekening,nama_bank,status 
		FROM `order` o JOIN bank b ON o.id_bank = b.id_bank WHERE username = :username ORDER BY status,tanggal_order DESC");
		$statement->execute([':username'=>$username]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan id order berdasarkan customer tertentu
function getOrderbyId($username,$id)
{
	try {
		$statement = DB->prepare("SELECT id_order,tanggal_order,total_order,no_rekening,nama_bank,status ,o.id_bank
		FROM `order` o JOIN bank b ON o.id_bank = b.id_bank WHERE username = :username AND id_order=:id_order");
		$statement->execute([':username'=>$username,':id_order'=> $id]);
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data di order detail berdasarkan id
function getDetailOrder($id){
	try {
		$statement = DB->prepare("SELECT * FROM order_detail od JOIN produk p ON od.id_produk = p.id_produk
		WHERE id_order = :id_order");
		$statement->execute([':id_order'=>$id]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menghapus order berdasarkan id
function deleteOrderById($id)
{
	try {
		$statement = DB->prepare("DELETE FROM order_detail WHERE id_order = :id");
		$statement->execute(array(":id" => $id));
		$statement = DB->prepare("DELETE FROM `order` WHERE id_order = :id");
		$statement->execute(array(":id" => $id));
		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
		
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mengupdate order berdasarkan id
function updateOrder($id_bank,$no_rekening,$id)
{
	try {
		$statement = DB->prepare("UPDATE `order` SET id_bank=:id_bank ,no_rekening=:no_rekening where id_order=:id");
		$statement->execute(array(":id_bank" => $id_bank,':no_rekening' => $no_rekening,':id'=>$id));
		header("Location: daftar_transaksi.php");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

//------------------------------- end Customer ------------------------------------------




//------------------------------- Admin ------------------------------------------

// fungsi query untuk mendapatkan semua data produk
function getAllDataProducts()
{
	try {
		$statement = DB->prepare("SELECT * FROM produk");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data customer
function getAllDataCustomer()
{
	try {
		$statement = DB->prepare("SELECT * FROM customer");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data supplier
function getAllDataSupplier()
{
	try {
		$statement = DB->prepare("SELECT * FROM supplier");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menghapus produk berdasarkan id di database
function deleteProduct($id) 
{
	try {
		$statement = DB->prepare("DELETE FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan produk berdasarkan id 
function getProductById($id) 
{
	try {
		$statement = DB->prepare("SELECT * FROM produk WHERE id_produk = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk menghapus supplier berdasarkan id di database
function deleteSupplier($id) 
{
	try {
		$statement = DB->prepare("DELETE FROM supplier WHERE id_supplier = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan supplier berdasarkan id 
function getSupplierById($id) {
	try {
		$statement = DB->prepare("SELECT * FROM supplier WHERE id_supplier = :id");
		$statement->execute(array(":id" => $id));
		return $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mendapatkan semua data order
function getAllOrder()
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` o JOIN bank b on o.id_bank=b.id_bank ORDER BY status,tanggal_order DESC");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// fungsi query untuk mengupdate status order
function updateStatusOrder($id)
{
	try {
		$statement = DB->prepare("UPDATE `order` SET status=:satu where id_order=:id");
		$statement->execute(array(":satu" => 1,':id'=>$id));
		$stat1 = DB->prepare("SELECT p.id_produk,jumlah_produk,stok_produk FROM order_detail od 
		JOIN produk p ON p.id_produk = od.id_produk WHERE id_order=:id ");
		$stat1->execute(array(':id'=>$id));
		$products = $stat1->fetchAll(PDO::FETCH_ASSOC);
		foreach($products as $product){
			$stat2 = DB->prepare("UPDATE `produk` SET stok_produk=:jumlah where id_produk=:id");
			$stokUpdate = $product['stok_produk']-$product['jumlah_produk'];
			$stat2->execute(array(":jumlah" =>$stokUpdate ,':id'=>$product['id_produk']));
		}
		$previousPage = $_SERVER['HTTP_REFERER'];
		header("Location: $previousPage");
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// --------------------------- end Admin ----------------------------------------




//------------------------------- Manajer ------------------------------------------

function getAllOrders($status) 
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` WHERE status = :status ORDER BY tanggal_order");
		$statement->execute([":status"=>$status]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllOrderByStatusAndTime($time1,$time2,$status)
{
	try {
		$statement = DB->prepare("SELECT * FROM `order` WHERE (tanggal_order BETWEEN :time1 AND :time2) 
		AND status=:status ORDER BY tanggal_order");
		$statement->execute([':time1'=>$time1,':time2'=>$time2,':status'=>$status]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

function getAllCategoryStock() {
	try {
		$statement = DB->prepare("SELECT nama_kategori, SUM(stok_produk) AS stok FROM produk p JOIN kategori k ON p.id_kategori = k.id_kategori WHERE p.id_kategori = k.id_kategori GROUP BY nama_kategori;");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo $err->getMessage();
	}
}

// ---------------------------end Manajer ----------------------------------------
