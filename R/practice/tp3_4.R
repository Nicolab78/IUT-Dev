droite1 <- function(x, y) {
  m <- covariance(x, y) / variance1(x)
  p <- mean(y) - m * mean(x)
  return(c(m, p))
}
droite2 <- function(x, y) {
  m <- covariance(x, y) / variance1(y)
  p <- mean(x) - m * mean(y)
  return(c(1 / m, -p / m))
}

plot(x, y, pch = 19,
     main = "Régression : droite1 (rouge) vs droite2 (bleue)")

a <- droite1(x, y)
abline(a[2], a[1], col = "red")

b <- droite2(x, y)
abline(b[2], b[1], col = "blue")

cor(x, y)