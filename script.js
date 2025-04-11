document.getElementById("voteForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const selectedParty = document.querySelector('input[name="party"]:checked').value;
    alert(`You voted for: ${selectedParty}\nThank you for participating! 🇮🇳`);
    this.reset();
  });
  