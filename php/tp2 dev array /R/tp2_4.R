dunif(5, min = 0, max = 10)

dunif(50, min = 0, max = 10)

x <- seq(-2, 12, by = 0.1)
y <- dunif(x, min = 0, max = 10)
plot(x, y, type = "l",
     main = "Densité de la loi uniforme [0, 10]",
     xlab = "x", ylab = "densité",
     col = "blue", lwd = 2)