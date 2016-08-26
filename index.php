<html ng-app="app">
    <head>
        <title>Meine Seite</title>
		<meta charset="UTF-8">
	    <meta name="PHP bible demos" content="Demos showing how to use the PHP bible">
        <meta name="keywords" content="PHP bible demos">
        <meta name="author" content="blurry-code">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel=”author” href="https://github.com/blurry-code" />
        
        <link href="css/style.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
         
        <script src="http://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      
        <script src="js/main.js"></script>
    </head>
    <body>
        <nav class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand" ui-sref="home">PHP bible</div>
                </div>
                <!--<ul class="nav navbar-nav">
                    <li><a href="#">Startseite</a></li>
                    <li><a href="more.html"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a></li>
                </ul>-->
            </div>
        </nav> 
        
        <div class="container">
            <div class="main">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#intro" aria-controls="intro" role="tab" data-toggle="tab">intro</a></li>
                    <li role="presentation"><a href="#demo1" aria-controls="demo1" role="tab" data-toggle="tab">demo 1</a></li> 
                    <li role="presentation"><a href="#demo2" aria-controls="demo2" role="tab" data-toggle="tab">demo 2</a></li>
                    <li role="presentation"><a href="#demo3" aria-controls="demo3" role="tab" data-toggle="tab">demo 3</a></li>
                    <li role="presentation"><a href="#demo4" aria-controls="demo4" role="tab" data-toggle="tab">demo 4</a></li> 
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                <br />
                <div role="tabpanel" class="tab-pane active" id="intro"> 
                    <script>
                        // chooseDemo(0);
                    </script>
                    <br />
                    <legend>Intro</legend>
                 <!--   <p>
                        the php should be adjusted in following way:<br />
                        Books, chapters and verses should all be parsed the same. The function returns an array of arrays. Each sub array would be a range. Should the sub array only consist of 1 element then it is a single verse, chapter or book. As in [[1-3],[5]], which would translate to 1 through 3 and 5. So the most simple call for an entire book would produce the array [[1]].<br />
                        As soon as there is a range in the next higher section (for chapter this would be book), the values are interpreted as range as well. So if the book value is 1-2, the following can happen:<br />
                        chapter can be a range [31-5]. So this would translate to book 1 chapter 31 ranged to book 2 chapter 5.<br />
                        This ultimately calls for discarding any range arrays as in chapter 1 verses 1 through 3 and 7 through 11.

                    </p> -->
                    <p>
                        The PHP bible is very much a work in progress.<br />
                        Should you like the idea of it, want to use it, join the development of it or fund it, please contact me at <a href="mailto:&#105;&#110;&#102;&#111;&#064;&#116;&#111;&#098;&#105;&#097;&#115;&#045;&#112;&#104;&#105;&#108;&#105;&#112;&#112;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#116;&#111;&#098;&#105;&#097;&#115;&#045;&#112;&#104;&#105;&#108;&#105;&#112;&#112;&#046;&#099;&#111;&#109;</a><br />
                        <br />
                        While the documentation is still lacking, here are some information on how it works:
                    </p>
                    <ul>
                        <li>PHP bible uses the Zefania XML bible markup language.<br />A list of bibles to download can be found <a href="https://sourceforge.net/projects/zefania-sharp/files/Bibles/" target="_blank">here</a><br />Bibles are available in 57 languages and several translations for some languages.</li>
                        <li>The PHP script takes parameters as $_GET variables.</li>
                        <li>The script searches through an entire xml bible to find the right scripture, then formats it, mainly removing some of the xml tags that caused problems and send it back as a string.</li>
                        <li>In the final result there are classes set for chapter title, chapter text, vers numbers and the verses.</li>
                    </ul>
  
                    <br />
                  <!--  <legend>Develop</legend>
                    <div class="result"></div>
-->
                </div>
                    
                    
                <!-- TABS -->
                    
                <div role="tabpanel" class="tab-pane" id="demo1">
                    <script>
                        chooseDemo(1);
                    </script>
                    <br />
                    <legend>by reference</legend>
                    <br />
                    <p>Fetching scripture by <i>reference</i> is more limited than using the other parameters directly:</p>
                    <ul>
                        <li>all other parameters are ignored if <i>reference</i> is set</li>
                        <li>the reference has to be in one of following formats 
                            <ul>
                                <li>book</li>
                                <li>book chapter</li>
                                <li>book chapter1<strong>-</strong>chapter2 (chapter1 <= chapter2)</li>
                                <li>book chapter<strong>:</strong>verse</li>
                                <li>book chapter<strong>:</strong>verse1<strong>-</strong>verse2 (verse1 <= verse2)</li>
                            </ul>
                        </li>
                    </ul>
                    <br />
                    <div class="row">
                        <div class="col-xs-3">
                            <legend>Reference</legend>
                                1. Buch Mose 6:5-7
                        </div>
                        <div class="col-xs-4">
                            <legend>PHP parameters</legend>
                            <div class="col-xs-6">
                                <strong>reference</strong><br />
                            </div>
                            <div class="col-xs-6">
                                1. Buch Mose 6:5-7
                            </div>
                        </div>
                    </div>
                    <br />
                    <legend>Result</legend>
                    <div class="result"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="demo2">
                    <script>
                        chooseDemo(2);
                    </script>
                    <br />
                    <legend>whole book</legend>
                    <br />
                    <p>When there is no <i>chapter</i> value set, any value for <i>verses</i> will be ignored. The entire <i>book</i> will be chosen.</p>
                    <div class="row">
                        <div class="col-xs-3">
                            <legend>Reference</legend>
                            Jonah
                        </div>
                        <div class="col-xs-3">
                            <legend>PHP parameters</legend>
                            <div class="col-xs-6">
                                <strong>book</strong><br />
                            </div>
                            <div class="col-xs-6">
                                32
                            </div>
                        </div>
                    </div>
                    <br />
                    <legend>Result</legend>
                    <div class="result"></div>
                </div>    
                <div role="tabpanel" class="tab-pane" id="demo3">
                    <script>
                        chooseDemo(3);
                    </script>
                    <br />
                   <!-- <legend>TODO</legend>
                    <strong></strong><br />
                    <br />-->
                    <legend>whole chapter</legend>
                    <br />
                    <p>When there is no <i>verses</i> value set, the entire <i>chapter</i> will be chosen.</p>
                    <div class="row">
                        <div class="col-xs-3">
                            <legend>Reference</legend>
                            Genesis 6
                        </div>
                        <div class="col-xs-3">
                            <legend>PHP parameters</legend>
                            <div class="col-xs-6">
                                <strong>book</strong><br />
                                <strong>chapter</strong>
                            </div>
                            <div class="col-xs-6">
                                1<br />
                                6
                            </div>
                        </div>
                    </div>
                    <br />
                    <legend>Result</legend>
                    <div class="result"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="demo4">
                    <script>
                        chooseDemo(4);
                    </script>
                    <br />
                    <legend>one verse</legend>
                    <br />
                    <div class="row">
                        <div class="col-xs-3">
                            <legend>Reference</legend>
                            1 John 1:1
                        </div>
                        <div class="col-xs-3">
                            <legend>PHP parameters</legend>
                            <div class="col-xs-6">
                                <strong>book</strong><br />
                                <strong>chapter</strong><br />
                                <strong>verses</strong>
                            </div>
                            <div class="col-xs-6">
                                62<br />
                                1<br />
                                1
                            </div>
                        </div>
                    </div>
                    <br />
                    <legend>Result</legend>
                    <div class="result"></div>
                    <br />
                    <div id="demo5">
                        <div class="row">
                            <script>
                                chooseDemo(5);
                            </script>
                            <div class="col-xs-3">
                                <legend>Reference</legend>
                                1 John 1:1-4
                            </div>
                            <div class="col-xs-3">
                                <legend>PHP parameters</legend>
                                <div class="col-xs-6">
                                    <strong>book</strong><br />
                                    <strong>chapter</strong><br />
                                    <strong>verses</strong>
                                </div>
                                <div class="col-xs-6">
                                    62<br />
                                    1<br />
                                    1-4
                                </div>
                            </div>
                        </div>
                        <br />
                        <legend>Result</legend>
                        <div class="result"></div>
                    </div>
                  </div>
               
                
            </div> <!-- .main end -->
        </div> <!-- .container end -->
        <!--
        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container">
                <div class="navbar-header">
                    <p class="navbar-text">&copy; 2016 PHP bible</p>
                    <a class="navbar-brand" href="about.html">about</a>
                </div>
            </div>
        </div>    
        -->
        <script src="//localhost:35729/livereload.js"></script>
    </body>
</html>