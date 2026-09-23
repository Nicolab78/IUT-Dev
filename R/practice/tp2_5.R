echantillon <- runif(1000, min = 0, max = 10)

plot(density(echantillon),
     main = "Densité empirique d'un échantillon uniforme",
     xlab = "x", col = "red", lwd = 2)

lines(x, y, col = "blue", lwd = 2, lty = 2)
legend("topright", legend = c("Empirique", "Théorique"),
       col = c("red", "blue"), lty = c(1, 2))