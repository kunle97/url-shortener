<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel URL Shortener</title>
  <link rel="stylesheet" href="{{url('css/style.css')}}">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>
<body>
  <div class="wrapper">
    <h1 style="font-weight: 300; margin-bottom: 15px; " ><center>Top 100 URLs</center></h1>
    <!-- <form action="{{route('saveURL')}}" method="POST" autocomplete="off">
      <input type="text" spellcheck="false" name="full_url" placeholder="Enter or paste a url" required>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <i class="url-icon uil uil-link"></i>
      <button type="submit" >Shorten</button>
    </form> -->

    
        <div class="statistics">


            
            <span>Total Links: <span><?php echo $urls->count() ?></span></span>
            <a href="{{route('index')}}">Add a URL</a>
        </div>
        <!--URL LIST-->
        <div class="urls-area">
          <div class="title">
            <li>Shortened URL</li>
            <li>Original URL</li>
            <li>Clicks</li>
            <li>Action</li>
          </div>

              @foreach ($urls as $url)
                <div class="data">
                <li>
                <?php  $domain =  $_SERVER['SERVER_NAME']."/"; ?>
                  <a href="{{ route('click', $url->shorten_url) }}" target="_blank">
                  <?php
                    if($domain.strlen($url->shorten_url) > 50){
                      echo $domain.substr( $url->shorten_url, 0, 50) ;
                    }else{
                      echo $domain. $url->shorten_url;
                    }
                  ?>



                  </a>
                </li> 
                <li>
                  <?php
                    if(strlen( $url->full_url) > 60){
                      echo substr($url->full_url, 0, 60) . '...';
                    }else{
                      echo $url->full_url;
                    }
                  ?>
                </li> 
              </li>
                <li><?php echo $url->clicks ?></li>
                <li><a href="{{route('deleteURL', $url->id)}}">Delete</a></li>
              </div>
              @endforeach

        </div>
  </div>

  <div class="blur-effect"></div>
  <div class="popup-box">
  <div class="info-box">Your short link is ready. You can also edit your short link now but can't edit once you saved it.</div>
  <form action="#" autocomplete="off">
    <label>Edit your shorten url</label>
    <input type="text" class="shorten-url" spellcheck="false" required>
    <i class="copy-icon uil uil-copy-alt"></i>
    <button>Save</button>
  </form>
  </div>


</body>
</html>