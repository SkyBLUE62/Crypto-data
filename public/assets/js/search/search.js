$.ajax({
    url: "/search",
    method: "GET",
    success: function (data) {
      $("#searchInput").autocomplete({
        source: data["nomCoin"],
        position: { my: "left top", at: "left bottom" },
        minLength: 3,
        maxHeight: 200,
        width: 300,
      });
    },
  });
