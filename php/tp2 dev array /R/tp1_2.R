n <- 20
p <- 1/4

p_exact_5 <- dbinom(5, size = n, prob = p)
cat("P(X = 5) =", round(p_exact_5, 4), "\n")

p_au_moins_8 <- 1 - pbinom(7, size = n, prob = p)
cat("(P(X >= 8) =", round(p_au_moins_8, 4), "\n")

esperance <- n * p
variance <- n * p (1 - p)
cat("E(X) =",esperance, "\n")
cat("V(X) =", variance, "\n")