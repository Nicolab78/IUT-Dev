x <- c(2, 2.3, 2.6, 2.9, 3.2, 3.5, 3.8, 4.1)
y <- c(52, 59, 60, 65, 70, 72, 73, 75)

plot(x, y,
     main = "Nuage de points",
     xlab = "x", ylab = "y",
     pch = 19, col = "black")

a <- droite1(x, y)
abline(a[2], a[1], col = "red", lwd = 2)

curve(10 * sqrt(x) + 30, from = 2, to = 4.1, add = TRUE, col = "darkgreen", lwd = 2)

nouveaux_x <- c(3.0, 3.6)
nouveaux_y <- c(68, 74)
points(nouveaux_x, nouveaux_y, col = "blue", pch = 17, cex = 1.5)

lines(x, y, col = "orange", lty = 2)

legend("topleft",
       legend = c("Points", "Droite de régression", "Courbe", "Nouveaux points", "Trajet"),
       col = c("black", "red", "darkgreen", "blue", "orange"),
       pch = c(19, NA, NA, 17, NA),
       lty = c(NA, 1, 1, NA, 2))