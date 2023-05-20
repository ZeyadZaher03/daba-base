<!DOCTYPE html>
<html>

<head>
  <title>Facebook - login or signup</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <nav class="navbar">
    <img class="logo" src="fb.png">
    <form method="post" action="./includes/login.inc.php"  class="login_form">
      <div class="email">
        <div class="font">Email or Phone</div>
        <input type="text" name="email">
      </div>
      <div class="password">
        <div class="font">Password</div>
        <input type="password" name="password">
      </div>
      <button class="login_btn" name="submit">Login</button>
    </form>
  </nav>

  <section>
    <div class="logo_body">
      <img class="logobdy" src="fbbdy.png">
      <p class="like_font font1">Thanks for stopping by!</p>
      <p class="like_font">We hope to see you again soon.</p>
    </div>

    <div class="signup_body">

      <p class="acc_crt">Create an account</p>
      <p class="free_hint">It's free and always will be.</p>
      <form method="post" action="./includes/signup.inc.php" class="signup_form">
        <div>
          <input class="firstname" type="text" name="fname" placeholder="First name">
          <input class="lastname" type="text" name="lname" placeholder="Last name">
          <input class="email" type="text" name="email" placeholder="Mobile number or Email">
          <input class="password" type="password" name="password" placeholder="Password">
          <input class="password2" type="password" name="cpassword" placeholder="Confirm password">
        </div>
        <p class="birthday">Birthday</p>
        <div class="birth_date">
          <select class="month" name="month">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
          </select>

          <select class="day" name="day">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
          </select>

          <select class="year" name="year">
            <option>1990</option>
            <option>1991</option>
            <option>1992</option>
            <option>1993</option>
            <option>1994</option>
            <option>1995</option>
            <option>1996</option>
            <option>1997</option>
            <option>1998</option>
            <option>1999</option>
            <option>2000</option>
            <option>2001</option>
            <option>2002</option>
            <option>2003</option>
            <option>2004</option>
            <option>2005</option>
            <option>2006</option>
            <option>2007</option>
            <option>2008</option>
            <option>2009</option>
            <option>2010</option>
            <option>2011</option>
            <option>2012</option>
            <option>2013</option>
            <option>2014</option>
            <option>2015</option>
            <option>2016</option>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
            <option>2021</option>
            <option>2022</option>
            <option>2023</option>
          </select>
        </div>

        <button type="submit" name="submit" class="signup">Sign Up</button>

      </form>
    </div>

  </section>

</body>

</html>