<html>
<head>
<script type"javascript/text">
//Phase 1 = bid, 2=meld, 3=play
var phase = 0;
var hand = 1;
var t1Score = 0;
var t2Score = 0;
var t1Meld = 0;
var t2Meld = 0;
var t1Points = 0;
var t2Points = 0;
var bidTeam = 0;
var bid;

function addScore(){
var newScoreOne = document.getElementById("scoreOne");
var newScoreTwo = document.getElementById("scoreTwo");
if (newScoreOne.value=="") newScoreOne.value = "0";
if (newScoreTwo.value=="") newScoreTwo.value = "0";

if (phase==1) {
   t1Meld = parseInt(newScoreOne.value);
   t2Meld = parseInt(newScoreTwo.value);
   document.getElementById("btnAddScore").value = "Add Points"

   var t1ScoreText = document.getElementById("teamOneScore").innerHTML;
   var t2ScoreText = document.getElementById("teamTwoScore").innerHTML;
   document.getElementById("teamOneScore").innerHTML = t1ScoreText+"</br>&nbsp;&nbsp;&nbsp;" + t1Meld + "&nbsp;&nbsp;&nbsp;";
   document.getElementById("teamTwoScore").innerHTML = t2ScoreText+"</br>&nbsp;&nbsp;&nbsp;" + t2Meld + "&nbsp;&nbsp;&nbsp;";
   phase=2;
} else if (phase==2){
   t1Points = parseInt(newScoreOne.value);
   t2Points = parseInt(newScoreTwo.value);
   document.getElementById("btnAddScore").value = "Add Meld"
   document.getElementById("addPointsRow").style.visibility="collapse";
   document.getElementById("addPointsBtnRow").style.visibility="collapse";
   document.getElementById("setBidRow").style.visibility="visible";
   if (bidTeam==1) {
     if(t1Meld+t1Points<parseInt(bid)) {
        t1Points = parseInt(bid)* -1;
	t1Meld = 0;
     }
   } else if (bidTeam==2){
     if(t2Meld+t2Points<parseInt(bid)) {
        t2Points = parseInt(bid)* -1;
        t2Meld = 0;
     }
   }

   t1Score = t1Score + t1Points + t1Meld
   t2Score = t2Score + t2Points + t2Meld
   var t1ScoreText = document.getElementById("teamOneScore").innerHTML;
   var t2ScoreText = document.getElementById("teamTwoScore").innerHTML;
   document.getElementById("teamOneScore").innerHTML = "<del>"+t1ScoreText+"</del></br><u>&nbsp;&nbsp;&nbsp;" +t1Points + "&nbsp;&nbsp;&nbsp;</u></br>&nbsp;&nbsp;&nbsp;"+t1Score+"&nbsp;&nbsp;&nbsp;";
   document.getElementById("teamTwoScore").innerHTML = "<del>"+t2ScoreText+"</del></br><u>&nbsp;&nbsp;&nbsp;" +t2Points + "&nbsp;&nbsp;&nbsp;</u></br>&nbsp;&nbsp;&nbsp;"+t2Score+"&nbsp;&nbsp;&nbsp;";

   phase = 0;
   hand = hand +1;
}

newScoreOne.value = "";
newScoreTwo.value = "";
}

function setOther(curTeam){
  if (curTeam==1 && document.getElementById("scoreTwo").value=="" && phase==2){
    var curScore = parseInt(document.getElementById("scoreOne").value)
    var otherScore = 25-curScore
    document.getElementById("scoreTwo").value = otherScore
  } else if (curTeam==2 && document.getElementById("scoreOne").value=="" && phase==2){
    var curScore = parseInt(document.getElementById("scoreTwo").value)
    var otherScore = 25-curScore
    document.getElementById("scoreOne").value = otherScore
  }
}

function setBid(){
var bids = document.getElementById("handBids");
var teamNums = document.pinochle.team;
for (i=0; i<teamNums.length;i++) {
  if (teamNums[i].checked==true)
    bidTeam = i+1;
}
var dealer = ""
if (hand%4==1) dealer=" North"
else if (hand%4==2) dealer=" East"
else if (hand%4==3) dealer=" South"
else if (hand%4==0) dealer=" West"
bid = document.getElementById("bid").value;
if (hand>1) bids.innerHTML = bids.innerHTML + "</br></br></br>"
bids.innerHTML = bids.innerHTML + "&nbsp;&nbsp;&nbsp;"+bid+dealer+"&nbsp;&nbsp;&nbsp;"
document.getElementById("setBidRow").style.visibility="collapse";
document.getElementById("addPointsRow").style.visibility="visible";
document.getElementById("addPointsBtnRow").style.visibility="visible";
phase=1;
}
</script>
</head>
<body>
<form name="pinochle">
<table style="font-size:xx-large">
<th>Team 1</th><th>Team 2</th><th>Bid</th>
<tr>
<td id="teamOneScore">
&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;
</td>
<td id="teamTwoScore">
&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;
</td>
<td id="handBids" valign="top">
</td>
</tr>
<tr id="setBidRow" style="visibility: visible;">
<td colspan="3" style="font-size:small">
<input type="text" id="bid"/>
<input type="radio" name="team" value="1"checked="true"/> Team 1
<input type="radio" name="team" value="2"/> Team 2
<input type="button" id="btnSetBid" name="btnSetBid" value="Set Bid" onClick="setBid()"/>
</td>
</tr>
<tr id="addPointsRow" style="visibility: hidden;">
<td>
<input type="text" id="scoreOne" onblur="setOther(1)"/></br>
</td>
<td>
<input type="text" id="scoreTwo" onblur="setOther(2)"/></br>
</td>
<td>
</td>
</tr>
<tr id="addPointsBtnRow" style="visibility: hidden;">
<td colspan="3">
<input type="button" name="btnAddScore" id="btnAddScore" value="Add Meld" onclick="addScore()"/>
</td>
</tr>
</table>
</form>
<a href="http://stackoverflow.com/users/1068058/ajon">
<img src="http://stackoverflow.com/users/flair/1068058.png?theme=dark" width="208" height="58" alt="profile for ajon at Stack Overflow, Q&amp;A for professional and enthusiast programmers" title="profile for ajon at Stack Overflow, Q&amp;A for professional and enthusiast programmers">
</a>
<a href="http://CompleteSolar.com">css</a>
</body>
</html>




