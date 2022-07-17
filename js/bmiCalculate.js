function calculateBmi() {
  var height = Number(document.getElementById("height").value);
  var weight = Number(document.getElementById("weight").value);
  if(weight > 0 && height > 0) {
    var finalBmi = weight/(height/100*height/100)
    document.getElementById("bmi").value = finalBmi.toFixed(1);
    if(finalBmi < 18.5){
      document.getElementById("meaning").value = "저체중"
    }
    if(finalBmi >= 18.5 && finalBmi <= 22.9) {
      document.getElementById("meaning").value = "정상"
    }
    if(finalBmi >= 23 && finalBmi <= 24.9) {
      document.getElementById("meaning").value = "과체중"
    }
    if(finalBmi >= 25 && finalBmi < 30) {
      document.getElementById("meaning").value = "경도 비만 (1단계 비만)"
    }
    if(finalBmi >= 30 && finalBmi < 35) {
      document.getElementById("meaning").value = "중등도 비만 (2단계 비만)"
    }
    if(finalBmi >= 35) {
      document.getElementById("meaning").value = "고도 비만"
    }
  }
  else {
    alert("신장과 몸무게를 바르게 입력해주세요.");
  }
}
