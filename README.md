

<h1>Laravel Inventory App</h1>
	<img src="/screenshots/login.png" alt="Screenshot of the inventory app" />


This is a simple inventory management app built with Laravel and Filament. It allows you to create, read, update, and delete inventory items, as well as view a dashboard with summary statistics.

<h2>Requirements</h2>
	<ul>
		<li>PHP 7.4 or later</li>
		<li>Composer</li>
		<li>MySQL database</li>
	</ul>

<h2>Installation</h2>
<ol>
	<li>Clone this repository to your local machine.</li>
		<li>Copy the <code>.env.example</code> file to <code>.env</code> and update the database configuration settings.</li>
		<li>Run <code>composer install</code> to install the required dependencies.</li>
		<li>Run <code>php artisan key:generate</code> to generate an application key.</li>
		<li>Run <code>php artisan migrate</code> to create the database tables.</li>
		<li>Run <code>php artisan serve</code> to start the development server.</li>
	</ol>

<h2>Usage</h2>
To use the app, visit <code>http://localhost:8000</code> in your web browser. You will be presented with a login screen. Use the following credentials to log in:
<ul>
		<li>Email: <code>admin@example.com</code></li>
		<li>Password: <code>password</code></li>
	</ul>
Once you're logged in, you can create, edit, and delete inventory items from the dashboard.

<h2>Development</h2>
To contribute to the development of this app, you can follow these steps:
	<ol>
		<li>Fork this repository to your GitHub account.</li>
		<li>Clone your fork to your local machine.</li>
		<li>Create a new branch for your changes (<code>git checkout -b my-new-feature</code>).</li>
		<li>Make your changes and commit them (<code>git commit -am 'Add some feature'</code>).</li>
		<li>Push your changes to your fork (<code>git push origin my-new-feature</code>).</li>
		<li>Create a new pull request on GitHub.</li>
	</ol>

<h2>License</h2>
	This app is open source and available under the MIT License. See the <code>LICENSE</code> file for more information.
    
<h2>Screenshots</h2>
<div class="row">
  <div class="col-md-6">
    <img src="/screenshots/login.png" alt="Screenshot of the inventory app" />
    <img src="/screenshots/cat.png" alt="Screenshot of the inventory app" />
    <img src="/screenshots/create_cat.png" alt="Screenshot of the inventory app" />
  </div>
  <div class="col-md-6">
    <img src="/screenshots/items.png" alt="Screenshot of the inventory app" />
    <img src="/screenshots/stock.png" alt="Screenshot of the inventory app" />
    <img src="/screenshots/stock_his.png" alt="Screenshot of the inventory app" />
  </div>
</div>

