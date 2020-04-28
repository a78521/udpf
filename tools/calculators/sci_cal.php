<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,greek' rel='stylesheet' type='text/css'>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/2.6.0/math.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<style>
* {
  font-family: 'Open Sans', 'Helvetica', 'Arial', sans-serif;
  box-sizing: border-box;
}

h1,
h2,
h3,
h4 {
  font-weight: 900;
}

body {
  background: rgba(252, 208, 122, 1);
  font-weight: 300;
  margin: 0;
}

.wrapper {
  width: 100%;
}

.calc {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
}

.top {
  max-width: 400px;
  width: 100%;
  background: #FFF9F9;
  color: #444;
  border-radius: 10px 10px 0 0;
}

.result {
  box-sizing: border-box;
  width: 100%;
  height: 30px;
  font-size: 16px;
  margin: 0;
  padding: 7px 10px 0px 10px;
  text-align: left;
  opacity: 0.6;
  overflow: hidden;
}

.screen {
  width: 100%;
  height: 50px;
  border: 0;
  font-size: 30px;
  padding: 0px 20px 5px 5px;
  text-align: right;
  display: flex;
  align-items: baseline;
  justify-content: flex-end;
  overflow: hidden;
}

.hints {
  opacity: 0.3;
}

.keyboard {
  max-width: 400px;
  width: 100%;
  box-shadow: inset 10px -88px 160px 23px rgba(0, 0, 0, 0.8), 5px 35px 191px -43px rgba(255, 0, 255, 0.5);
  margin-bottom: 50px;
}

.crow {
  display: flex;
  flex-direction: row;
  align-items: stretch;
  ;
  justify-content: space-around;
  ;
  width: 100%;
  min-height: 50px;
  margin: auto;
}

.crow:last-child {
  border-radius: 0px 0px 10px 10px;
}

.cb {
  box-sizing: border-box;
  width: 100%;
  text-align: center;
  padding: 5px;
  background: rgba(255, 228, 240, 1);
  color: #444;
  cursor: pointer;
  outline: 1px solid rgba(136, 14, 79, 0.1);
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  box-shadow: none;
  transition: all 0.2s;
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  -o-user-select: none;
}

.cb:hover {
  box-shadow: 10px 10px 18px -6px rgba(233, 30, 99, 0.5);
  z-index: 1000;
}

.cb:active {
  box-shadow: inset 10px 10px 18px -6px rgba(233, 30, 99, 0.5);
}

.screentext {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.animated {
  position: relative;
  top: 0;
  animation: movetext1 .2s 1;
}

@keyframes movetext1 {
  0% {
    top: 100px;
  }
  100% {
    top: 0px;
  }
}

sup {
  vertical-align: text-top;
  font-size: 0.5em;
}

.inv {
  display: none;
}

.lighter {
  background-color: rgba(255, 235, 238, 1);
  font-size: 1.2em;
}

.operands {
  background-color: rgba(255, 155, 160, 1);
  color: #eee;
  font-size: 1.6em;
}

.enter {
  background-color: rgba(254, 111, 118, 1);
  color: #eee;
  font-size: 2em;
}
</style>
</head>

<body>
   <div class="wrapper">
    <h1 style="text-align:center"></h1>
    <div class="calc">
      <div class="top">
        <div class='result'></div>
        <div class='screen'><span id="screentext" class="screentext animated"></span><span class="hints"></span></div>
      </div>
      <div class="keyboard">

        <div class="crow">
          <div class='cb cbac'>AC</div>
          <div class="cb cbpar" key='('>(</div>
          <div class="cb cbpar" key=')'>)</div>
          <div class='cb cbce'>CE</div>
        </div>

        <div class="crow">
          <div class="cb cbnum" key='pi'>π</div>
          <div class="cb cbnum" key='e'>e</div>
          <div class="cb cbnum" key='phi'>φ</div>
          <div class="cb cbnum" key='tau'>τ</div>
        </div>

        <div class="crow">
          <div class="cb cbinv">Inv</div>
          <div class="cb cbfun" key1='sin(' key2="asin(">sin<sup class="inv">-1</sup></div>
          <div class="cb cbfun" key1='cos(' key2="acos(">cos<sup class="inv">-1</sup></div>
          <div class="cb cbfun" key1='tan(' key2="atan(">tan<sup class="inv">-1</sup></div>
        </div>

        <div class="crow">
          <div class="cb cbfun" key1='log10('>log</div>
          <div class="cb cbfun" key1='log('>ln</div>
          <div class="cb cbop" key='!' char='!'>!</div>
          <div class="cb cbop" key='deg' char='deg'>deg</div>
        </div>

        <div class="crow">
          <div class="cb cbfun" key1='sqrt('>√</div>
          <div class="cb cbop" key='^2' char='²'>x²</div>
          <div class="cb cbop" key='^3' char='³'>x³</div>
          <div class="cb cbop" key='^' char='^'>^</div>
        </div>

        <div class="crow">
          <div class="cb cbnum lighter" key='7'>7</div>
          <div class="cb cbnum lighter" key='8'>8</div>
          <div class="cb cbnum lighter" key='9'>9</div>
          <div class="cb cbop operands" key='/' char='÷'>÷</div>
        </div>

        <div class="crow">
          <div class="cb cbnum lighter" key='4'>4</div>
          <div class="cb cbnum lighter" key='5'>5</div>
          <div class="cb cbnum lighter" key='6'>6</div>
          <div class="cb cbop operands" key='*' char='×'>×</div>
        </div>

        <div class="crow">
          <div class="cb cbnum lighter" key='1'>1</div>
          <div class="cb cbnum lighter" key='2'>2</div>
          <div class="cb cbnum lighter" key='3'>3</div>
          <div class="cb cbop operands" key='-' char='-'>-</div>
        </div>

        <div class="crow">
          <div class="cb cbnum lighter" key='0'>0</div>
          <div class="cb cbnum lighter" key='.'>.</div>
          <div class="cb cbop lighter" key='E' char='E'>exp</div>
          <div class="cb cbop operands" key='+' char='+'>+</div>
        </div>

        <div class="crow">
          <div class="cb cbrnd" style="width:25%">Rnd</div>
          <div class="cb cbans" style="width:25%">Ans</div>
          <div class="cb enter" style="width:50%">=</div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>
<script>
$(function() {

  var expression = '';
  var expressionArray = [];
  var screenArray = [];
  var parentheses = 0;
  var ansOnScreen = false;
  var ans = null;
  var error = false;
  var inverted = false;

  function defaults() {
    expression = '';
    expressionArray = [];
    screenArray = [];
    parentheses = 0;
    ansOnScreen = false;
    ans = null;
    error = false;
    inverted = false;
    $('.result').html('');
    $('.screentext').html('');
    $('.hints').html('');
  }

  function toggleInverted() {
    $('.cbfun .inv').toggle();
    inverted = inverted ? false : true;
  }

  function adjustParentheses(num) {
    $('.hints').html(')'.repeat(num));
  }

  function writeToScreen(mode, text) {

    if (mode == 'append') {
      if (error) {
        screenArray = [];
      }
      error = false;
      screenArray.push(text);
    } else if (mode == 'write') {
      screenArray = [text];
    } else if (mode == 'delete') {
      var popped = screenArray.pop();
      if (/[(]$/g.test(popped)) {
        parentheses > 0 ? parentheses-- : parentheses = 0;
        adjustParentheses(parentheses);
      }
    }

    $('.screentext').html(screenArray.join(''));

    if (inverted) {
      toggleInverted();
    }
  }

  function addToExpression(text) {
    expressionArray.push(text);
    expression += text;
  }

  function removeFromExpression() {
    var count = expressionArray.pop().length;
    expression = expression.slice(0, -count);
  }

  // ask for a result ----------------------------------------------------------
  $('.enter').click(
    function() {

      if (ansOnScreen) {
        expressionArray = [ans];
      }

      addToExpression(')'.repeat(parentheses));

      try {
        math.eval(expressionArray.join('')).toPrecision(8);
      } catch (e) {
        error = true;
      }

      if (error) {
        defaults();
        error = true;
        writeToScreen('write', 'Syntax Error');
      } else {
        $('.result').html($('.screentext').html().replace(/Ans/, ans) + ')'.repeat(parentheses) + ' =');
        ans = math.eval(expressionArray.join('')).toPrecision(8);
        writeToScreen('write', ans.toString().replace(/(\.0+$)|(0+$)/g, ''));
        $('.hints').html('');

        var el = $('#screentext');
        var newone = el.clone(true);
        el.before(newone);
        $(".animated:last").remove();

        ansOnScreen = true;
      }
      parentheses = 0;
      expression = '';
      expressionArray = [];
    }
  );

  // clear the screen ----------------------------------------------------------
  $('.cbac').click(
    function() {
      defaults();
    }
  );

  // add a number to the screen ------------------------------------------------
  $('.cbnum').click(
    function() {
      var key = $(this).attr('key');

      if (inverted) {
        toggleInverted();
      }

      if (ansOnScreen) {
        $('.result').html('Ans = ' + $('.screentext').html());
        writeToScreen('write', '');
        ansOnScreen = false;
      }

      addToExpression(key);
      writeToScreen('append', $(this).html());
    }
  );

  // add an operator to the screen if there's no other operator ----------------
  $('.cbop').click(
    function() {
      var key = $(this).attr('key');
      var char = $(this).attr('char');
      if (inverted) {
        toggleInverted();
      }

      if (ansOnScreen) {
        $('.result').html('Ans = ' + $('.screentext').html());
        writeToScreen('write', 'Ans');
        expression = ans;
        expressionArray = [ans];
        parentheses = 0;
        $('.hints').html('');
        ansOnScreen = false;
      }

      if ((/[/]$|[*]$/g.test(expression) && (key == '/' || key == '*'))) {
        writeToScreen('write', $('.screentext').html().replace(/[?]$|[?]$/g, char));
        removeFromExpression();
        addToExpression(key);
      } else if (/[+]$|[-]$/g.test(expression) && (key == '+' || key == '-')) {
        writeToScreen('write', $('.screentext').html().replace(/[+]$|[-]$/g, char));
        removeFromExpression();
        addToExpression(key);
      } else {
        writeToScreen('append', char);
        addToExpression(key);
      }

      ansOnScreen = false;
    }
  );

  // add a parentheses both to screen and to a global var ----------------------
  $('.cbpar').click(
    function() {
      var key = $(this).attr('key');
      if (inverted) {
        toggleInverted();
      }

      if (ansOnScreen) {
        writeToScreen('write', '');
        ansOnScreen = false;
      }

      addToExpression(key);
      writeToScreen('append', key);

      if (key == '(') {
        parentheses++;
        adjustParentheses(parentheses);
      } else if (key == ')') {
        parentheses > 0 ? parentheses-- : parentheses = 0;
        adjustParentheses(parentheses);
      }

    }

  );

  // add a function, change parentheses ----------------------------------------
  $('.cbfun').click(
    function() {
      var key1 = $(this).attr('key1');
      var key2 = $(this).attr('key2');

      if (ansOnScreen) {
        writeToScreen('write', '');
        ansOnScreen = false;
      }

      if (!inverted) {
        addToExpression(key1);
      } else {
        addToExpression(key2);
      }

      writeToScreen('append', $(this).html() + '(');

      parentheses++;
      adjustParentheses(parentheses);

      if (inverted) {
        toggleInverted();
      }

    }
  );

  // append the old result to the expression-----------------------------------------
  $('.cbans').click(
    function() {
      if (ansOnScreen) {
        writeToScreen('write', '');
        ansOnScreen = false;
      }
      if (!/[Ans]$|[0-9]$|[?]$|[e]$/g.test($('.screentext').html())) {
        addToExpression(ans.toString());
        writeToScreen('append', 'Ans');
      }

    }
  );

  // invert trig functions ----------------------------------------------------------
  $('.cbinv').click(
    function() {
      toggleInverted();
    }
  );

  // backspace -----------------------------------------------------------------------
  $('.cbce').click(
    function() {
      if (inverted) {
        toggleInverted();
      }
      if (ansOnScreen) {
        writeToScreen('write', '');
        ansOnScreen = false;
      }

      if (expressionArray.length) {
        removeFromExpression();
        writeToScreen('delete', '');
      }

    }
  );

  // Insert a random number ---------------------------------------------------------
  $('.cbrnd').click(
    function() {
      var key = Math.random().toPrecision(8);

      if (inverted) {
        toggleInverted();
      }

      if (ansOnScreen) {
        $('.result').html('Ans = ' + $('.screentext').html());
        writeToScreen('write', '');
        ansOnScreen = false;
      }

      addToExpression(key);
      writeToScreen('append', key);
    }
  );

});
</script>