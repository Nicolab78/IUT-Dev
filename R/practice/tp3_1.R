variance1 <- function(x) {
  return(mean(x^2) - mean(x)^2)
}
etype1 <- function(x) {
  return(sqrt(variance1(x)))
}
x <- c(2, 2.3, 2.6, 2.9, 3.2, 3.5, 3.8, 4.1)
variance1(x)
etype1(x)

sd(x) 
var(x) 