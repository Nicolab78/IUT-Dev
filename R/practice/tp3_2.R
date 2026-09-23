variance2 <- function(x, n) {
  return(weighted.mean(x^2, n) - weighted.mean(x, n)^2)
}
etype2 <- function(x, n) {
  return(sqrt(variance2(x, n)))
}
valeurs <- c(10, 20, 30, 40, 50)
effectifs <- c(14, 10, 12, 8, 10)
variance2(valeurs, effectifs)
etype2(valeurs, effectifs)