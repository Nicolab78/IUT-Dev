x <- runif(10000, min = 0, max = 10)
p_estimee <- mean(x > 7)
cat("P(X > 7) estimée :", p_estimee, "\n")

cat("P(X > 7) théorique : 0.3\n")

p_intervalle <- mean(x > 3 & x < 6)
cat("P(3 < X < 6) estimée :", p_intervalle, "\n")