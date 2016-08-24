# php-bible

The PHP bible is very much a work in progress. Since some of the main features are working already and in fact I am using it in a live project I put it here already. Use anything here at your own risk. If not this project does not get any funding it will receive updates only on an irregularly. 

## contact

 Should you like the idea of it, want to use it, join the development of it or fund it, please contact me at [&#105;&#110;&#102;&#111;&#064;&#116;&#111;&#098;&#105;&#097;&#115;&#045;&#112;&#104;&#105;&#108;&#105;&#112;&#112;&#046;&#099;&#111;&#109;](&#105;&#110;&#102;&#111;&#064;&#116;&#111;&#098;&#105;&#097;&#115;&#045;&#112;&#104;&#105;&#108;&#105;&#112;&#112;&#046;&#099;&#111;&#109;).
 
## about this project
 
While the documentation is still lacking, here are some information on how it works:
* PHP bible uses the Zefania XML bible markup language.<br />A list of bibles to download can be found <a href="https://sourceforge.net/projects/zefania-sharp/files/Bibles/" target="_blank">here</a><br />Bibles are available in 57 languages and several translations for some languages.
* The PHP script takes parameters as $_GET variables.
* The script searches through an entire xml bible to find the right scripture, then formats it, mainly removing some of the xml tags that caused problems and send it back as a string.
* In the final result there are classes set for chapter title, chapter text, vers numbers and the verses.

# run the demos

In order to run the local demo you must have npm and gulp installed globally and you need php installed and added the PATH of your users environment variables (not the systems).
* download the zip file and unpack it
* open terminal or command prompt in the folders location
* run `npm install`
* next visit https://sourceforge.net/projects/zefania-sharp/files/Bibles/GER/Schlachterbibel/Schlachter%20Bibel%201951%20with%20Strong/ and download this xml bible (sorry it's German for now ^^). Unzip the bible and place it in the `/bibles` folder
* back in terminal or command prompt run the command `gulp`

This should open your browser and show the demos. Should your browser not open automatically check out `http://localhost:8000/`in your browser.