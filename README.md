
# BuyTun

**BuyTun** is a school-based e-commerce platform developed to support students at **SMKN 2 KOTA BEKASI** (widely known as **BUTUN**) in marketing and showcasing their entrepreneurship projects.

## 📌 About This Project

BuyTun was created to assist students in completing their **PKKWU (Produk Kreatif dan Kewirausahaan)** assignments. These assignments require students to create and sell real products — BuyTun serves as a digital marketplace, allowing them to reach more potential buyers both inside and outside the school.

With BuyTun, students can:
- 🛍 Upload their PKKWU product assignments  
- 🌐 Reach a broader audience through the school’s online community  
- 📲 Share product links for easier promotion  
- 💡 Gain hands-on experience in digital entrepreneurship  

## 💡 Features

- Admin dashboard for managing products  
- Product upload form for student sellers  
- Product catalog with images, names, prices, and descriptions  
- Responsive design (mobile & desktop)  
- Integrated Font Awesome icons  

## 🛠 Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Framework:** [Bootstrap](https://getbootstrap.com/)  
- **Icons:** [Font Awesome](https://fontawesome.com/)  
- **Backend:** [PHP](https://www.php.net/)  
- **Database:** MySQL (via [phpMyAdmin](https://www.phpmyadmin.net/))  
- **Hosting:** Localhost using [XAMPP](https://www.apachefriends.org/) or similar  

## 📥 Installation Guide (Local Setup)

### Requirements
- XAMPP / Laragon (or any PHP server)
- phpMyAdmin
- Web browser

### Setup Steps
1. Clone or download the repository:
   ```bash
   git clone https://github.com/your-username/buytun.git
   ```
2. Move the project folder to your XAMPP `htdocs` directory:
   ```bash
   C:\xampp\htdocs\buytun\
   ```
3. Start Apache and MySQL from XAMPP.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`, create a new database (e.g., `buytun`), and import `buytun.sql`.
5. Ensure the database connection file `koneksi.php` (located in the root folder) contains the correct credentials:
   ```php
   <?php
   $koneksi = mysqli_connect("localhost", "root", "", "buytun");

   if (mysqli_connect_errno()) {
     echo "Database connection failed: " . mysqli_connect_error();
   }
   ?>
   ```
6. Run the project in your browser:  
👉 `http://localhost/buytun/`

## 📁 Project Folder Structure
```bash
buytun/
  ├── adminpanel/              # Admin panel folder
  ├── bootstrap/               # Bootstrap framework files
  ├── css/                     # Custom stylesheets
  ├── fontawesome/             # Font Awesome files (icons)
  ├── img/                     # Product or UI images
  ├── js/                      # JavaScript files

  ├── about.php                # About page
  ├── footer.php               # Footer component
  ├── index.php                # Homepage
  ├── koneksi.php              # Database connection file
  ├── navbar.php               # Navbar component
  ├── produk.php               # Product listing page
  ├── produk-detail.php        # Product detail page
```

## 👨‍💻 Developed By

Made with dedication by:  
**Iskandar (a.k.a. Doyok)**  
Student of the **Software Engineering (RPL)** Department, **SMKN 2 KOTA BEKASI**

## 🤝 Contributions

This project welcomes suggestions, improvements, and collaborations.  
Feel free to fork, open issues, or contribute!

## 📬 Contact

Let’s connect and collaborate:  
📧 Email: [iskandarofficial28@gmail.com](mailto:iskandarofficial28@gmail.com)  
🔗 LinkedIn: [linkedin.com/in/iskandar-208448320](https://www.linkedin.com/in/iskandar-208448320)
